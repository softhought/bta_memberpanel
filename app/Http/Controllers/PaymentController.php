<?php

namespace App\Http\Controllers;

use App\Constants\Constant;
use App\Models\Member;
use App\Models\PaymentRequest;
use App\Models\PaymentResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $memberInfo = Member::find($request->post('member_id'));
        $data = $request->all();

        $memberCode = (isset($memberInfo->member_code) && !empty($memberInfo->member_code)) ? $memberInfo->member_code : 'N/A';
        $mobileNo = (isset($memberInfo->primary_mobile) && !empty($memberInfo->primary_mobile)) ? $memberInfo->primary_mobile : '';
        $email = (isset($memberInfo->primary_email) && !empty($memberInfo->primary_email)) ? $memberInfo->primary_email : '';
        $memberName = trim(($memberInfo ? ($memberInfo->member_fname . ' ' . $memberInfo->member_lname) : ''));

        $totalAmount = is_array($data['amount']) ? array_sum($data['amount']) : (float)$data['amount'];

        $dataArray = array_merge($data, [
            'member_code'      => $memberCode,
            'member_name'      => $memberName,
            'mobile_no'        => $mobileNo,
            'email'            => $email,
            'customerMobileNo' => $mobileNo,
            'customerEmailID'  => $email,
            'customerName'     => $memberName,
            'programme_code'   => $data['programme_id'],
            'group_code'       => !empty($data['group_id']) ? $data['group_id'] : 0,
            'amount'           => $totalAmount,
        ]);

        $encryptedUrl = $this->initiatePayment($dataArray);

        if ($encryptedUrl === false) {
            return response()->json([
                'status' => false,
                'errors' => ['encryptedUrl' => ['Payment initiation failed. Please try again.']]
            ]);
        }

        $btaMemberData = session('btaMember');
        Cookie::queue('bta_member_cookie', json_encode($btaMemberData), 20);

        return response()->json(['status' => Constant::SUCCESS, 'encryptedUrl' => $encryptedUrl]);
    }

    public function initiatePayment($dataArray = [])
    {
        $merchantId = config('services.pgpay.merchant_id', '100000000515382');
        $aggregatorID = config('services.pgpay.aggregator_id', '100000000515381');
        $secretKey = config('services.pgpay.secret_key', '85f4eb97-cb28-4b9b-b49e-54909bf53202');
        $initiateUrl = config('services.pgpay.initiate_url', 'https://pgpay.icicibank.com/pg/api/v2/initiateSale');
        $returnUrl = config('services.pgpay.return_url', 'https://members.btaportal.in/payment-response');

        try {
            DB::beginTransaction();

            $serialMaster = DB::table('serialmaster')->where('moduleTag', 'TR')->first();
            $transaction_id = $serialMaster->module . sprintf('%05d', $serialMaster->lastnumber);
            $dataArray['transaction_number'] = $transaction_id;
            $dataArray['merchantTxnNo'] = $transaction_id;

            $date = now()->format('YmdHis');

            $customerMobileNo = !empty($dataArray['customerMobileNo']) ? $dataArray['customerMobileNo'] : (!empty($dataArray['mobile_no']) ? $dataArray['mobile_no'] : '9999999999');
            $customerEmailID = !empty($dataArray['customerEmailID']) ? $dataArray['customerEmailID'] : (!empty($dataArray['email']) ? $dataArray['email'] : 'devsofthought@gmail.com');
            $customerName = !empty($dataArray['customerName']) ? $dataArray['customerName'] : (!empty($dataArray['member_name']) ? $dataArray['member_name'] : 'Member');
            $addlParam1 = isset($dataArray['member_id']) ? (string)$dataArray['member_id'] : '';
            $addlParam2 = isset($dataArray['member_code']) ? (string)$dataArray['member_code'] : '';
            $amount = $dataArray['amount'];

            $payload = [
                'merchantId'       => (string)$merchantId,
                'aggregatorID'     => (string)$aggregatorID,
                'merchantTxnNo'    => (string)$dataArray['merchantTxnNo'],
                'amount'           => $amount,
                'currencyCode'     => '356',
                'payType'          => '0',
                'customerEmailID'  => (string)$customerEmailID,
                'transactionType'  => 'SALE',
                'returnURL'        => (string)$returnUrl,
                'txnDate'          => (string)$date,
                'customerMobileNo' => (string)$customerMobileNo,
                'customerName'     => (string)$customerName,
                'addlParam1'       => (string)$addlParam1,
                'addlParam2'       => (string)$addlParam2,
            ];

            // Build hash text with keys in alphabetical order
            $hashText =
                $payload['addlParam1'] .
                $payload['addlParam2'] .
                $payload['aggregatorID'] .
                $payload['amount'] .
                $payload['currencyCode'] .
                $payload['customerEmailID'] .
                $payload['customerMobileNo'] .
                $payload['customerName'] .
                $payload['merchantId'] .
                $payload['merchantTxnNo'] .
                $payload['payType'] .
                $payload['returnURL'] .
                $payload['transactionType'] .
                $payload['txnDate'];

            $payload['secureHash'] = self::generateHash($hashText, $secretKey);

            $response = Http::post($initiateUrl, $payload);

            DB::table('payment_request')->insert([
                'transaction_id'       => $transaction_id,
                'order_id'             => sha1($transaction_id),
                'paymeny_for'          => 'Fees Payments',
                'payment_geteway'      => 'PGPay',
                'amount'               => $dataArray['amount'],
                'enc_request'          => json_encode($payload),
                'plain_request'        => $hashText,
                'member_id'            => $dataArray['member_id'],
                'enrollment_id'        => $dataArray['enrollment_id'],
                'programme_id'         => $dataArray['programme_id'],
                'group_id'             => !empty($dataArray['group_id']) ? $dataArray['group_id'] : 0,
                'payment_session_data' => json_encode($dataArray),
                'processing_date'      => now(),
                'status'               => 'N',
                'is_checking'          => 'N',
            ]);

            DB::table('serialmaster')
                ->where('moduleTag', 'TR')
                ->update(['lastnumber' => $serialMaster->lastnumber + 1]);

            DB::commit();

            $resJson = $response->json();
            if (isset($resJson['responseCode']) && $resJson['responseCode'] === 'R1000' && !empty($resJson['redirectURI'])) {
                $encryptedUrl = $resJson['redirectURI'] . '?tranCtx=' . $resJson['tranCtx'];
                return $encryptedUrl;
            }

            Log::channel('payment')->error("PGPay initiateSale failed: ", [
                'transaction_id' => $transaction_id,
                'response'       => $response->body(),
            ]);

            return false;
        } catch (Exception $e) {
            DB::rollBack();
            Log::channel('payment')->error("PGPay initiatePayment exception: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            return false;
        }
    }

    public function paymentResponse(Request $request)
    {
        try {
            DB::beginTransaction();

            $response = $request->all();
            $referenceNo = $request->input('merchantTxnNo', $request->input('ReferenceNo'));

            $paymentRequestModel = PaymentRequest::where('transaction_id', $referenceNo)->first();

            if (!$paymentRequestModel) {
                DB::rollBack();
                Log::channel('payment')->error("PGPay response: transaction not found", ['response' => $response]);
                return redirect()->to('member/response')
                    ->with('message', $referenceNo)
                    ->with('status', 'error')
                    ->with('enrollment_id', null)
                    ->with('receipt_id', null)
                    ->with('payment_id', null);
            }

            $sessionData = json_decode($paymentRequestModel->payment_session_data, true);

            // Check if transaction is already marked paid
            if ($paymentRequestModel->status === 'Y') {
                DB::commit();
                return redirect()->to('member/response')
                    ->with('message', $referenceNo)
                    ->with('status', 'success')
                    ->with('enrollment_id', isset($sessionData['enrollment_id']) ? $sessionData['enrollment_id'] : null)
                    ->with('receipt_id', null)
                    ->with('payment_id', null);
            }

            $responseCode = (string)$request->input('responseCode', '');
            $txnResponseCode = (string)$request->input('txnResponseCode', '');
            $txnStatus = strtoupper((string)$request->input('txnStatus', ''));

            $paymentStatus = (
                $responseCode === '0000' ||
                $responseCode === '000' ||
                $txnResponseCode === '0000' ||
                $txnStatus === 'SUC'
            );

            $bankRefNo = $request->input('txnID', $request->input('Unique_Ref_Number'));
            $totalAmount = (float)$request->input('amount', $request->input('Total_Amount', $paymentRequestModel->amount));
            $paymentMode = $request->input('paymentMode', $request->input('Payment_Mode', ''));
            $paymentMsg = $request->input('txnRespDescription', $request->input('respDescription', ($paymentStatus ? 'Payment Successful' : 'Payment Failed')));

            $paymentResponseModel = PaymentResponse::updateOrCreate(
                ['transaction_id' => $paymentRequestModel->id],
                [
                    'order_id'        => $paymentRequestModel->order_id,
                    'payment_status'  => $paymentStatus ? 'Y' : 'N',
                    'processing_date' => now(),
                    'tracking_id'     => $referenceNo,
                    'bank_ref_no'     => $bankRefNo,
                    'payment_geteway' => 'PGPay',
                    'response_data'   => json_encode($response),
                    'payment_message' => $paymentMsg,
                ]
            );

            $paymentRequestModel->status = $paymentStatus ? 'Y' : 'N';
            $paymentRequestModel->is_checking = 'Y';
            $paymentRequestModel->save();

            $receipt_id = null;
            $payment_id = null;

            if ($paymentStatus) {
                $payableSum = is_array($sessionData['payable']) ? array_sum($sessionData['payable']) : (float)$sessionData['payable'];
                $bankCharges = $totalAmount - (float)$payableSum;

                $processRes = processPayment($sessionData, $paymentRequestModel, $bankCharges, $paymentMode);

                $receipt_id = isset($processRes['receipt_id']) ? $processRes['receipt_id'] : null;
                $payment_id = isset($processRes['payment_id']) ? $processRes['payment_id'] : null;
            }

            DB::commit();

            return redirect()->to('member/response')
                ->with('message', $referenceNo)
                ->with('status', $paymentStatus ? 'success' : 'error')
                ->with('enrollment_id', isset($sessionData['enrollment_id']) ? $sessionData['enrollment_id'] : null)
                ->with('receipt_id', $receipt_id)
                ->with('payment_id', $payment_id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::channel('payment')->error("PGPay paymentResponse error: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->to('member/response')
                ->with('message', isset($referenceNo) ? $referenceNo : '')
                ->with('status', 'error')
                ->with('enrollment_id', null)
                ->with('receipt_id', null)
                ->with('payment_id', null);
        }
    }

    public static function checkIciciPaymentStatus(string $merchantTxnNo, $amount)
    {
        $merchantId = config('services.pgpay.merchant_id', '100000000515382');
        $aggregatorID = config('services.pgpay.aggregator_id', '100000000515381');
        $secretKey = config('services.pgpay.secret_key', '85f4eb97-cb28-4b9b-b49e-54909bf53202');
        $statusUrl = config('services.pgpay.status_url', 'https://pgpay.icicibank.com/pg/api/command');

        $payload = [
            'merchantId'      => (string)$merchantId,
            'aggregatorID'    => (string)$aggregatorID,
            'merchantTxnNo'   => (string)$merchantTxnNo,
            'originalTxnNo'   => (string)$merchantTxnNo,
            'amount'          => $amount,
            'transactionType' => 'STATUS',
        ];

        $hashText =
            $payload['aggregatorID'] .
            $payload['amount'] .
            $payload['merchantId'] .
            $payload['merchantTxnNo'] .
            $payload['originalTxnNo'] .
            $payload['transactionType'];

        $payload['secureHash'] = self::generateHash($hashText, $secretKey);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($statusUrl, $payload);

        if ($response->failed()) {
            return [
                'success' => false,
                'error'   => $response->body(),
            ];
        }

        return [
            'success' => true,
            'data'    => $response->json(),
        ];
    }

    public static function generateHash(string $hashText, string $secretKey)
    {
        return hash_hmac('sha256', $hashText, $secretKey);
    }

    public function response(Request $request)
    {
        $cookieData = $request->cookie('bta_member_cookie');

        if ($cookieData) {
            $btaMemberData = json_decode($cookieData, true);
            session(['btaMember' => $btaMemberData]);
        }

        $data['bodyView'] = view('payment-response');
        return $this->renderView($data);
    }

    public function aes128Encrypt($str, $key)
    {
        $plaintext = $str;
        $cipher = "aes-128-ecb";
        $ciphertext = openssl_encrypt($plaintext, $cipher, $key, 0, "");
        return $ciphertext;
    }
}
