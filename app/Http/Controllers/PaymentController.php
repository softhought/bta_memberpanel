<?php

namespace App\Http\Controllers;

use App\Constants\Constant;
use App\Models\Member;
use App\Models\MemberReceiptDetail;
use App\Models\MemberReceiptMaster;
use App\Models\PaymentDetails;
use App\Models\PaymentMaster;
use App\Models\PaymentMode;
use App\Models\PaymentRequest;
use App\Models\PaymentResponse;
use App\Models\VoucherDetails;
use App\Models\VoucherMaster;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $memberInfo = Member::find($request->post('member_id'));
        $data = $request->all();

        $memberCode = isset($memberInfo->member_code) && !empty($memberInfo->member_code) ? $memberInfo->member_code : 'N/A';
        $mobileNo = isset($memberInfo->primary_mobile) && !empty($memberInfo->primary_mobile) ? $memberInfo->primary_mobile : 'N/A';
        $email = isset($memberInfo->primary_email) && !empty($memberInfo->primary_email) ? $memberInfo->primary_email : 'N/A';

        $dataArray = array_merge($data, [
            'member_code' => $memberCode,
            'member_name' => "{$memberInfo->member_fname} {$memberInfo->member_lname}",
            'mobile_no' => $mobileNo,
            'email' => $email,
            'programme_code' => $data['programme_id'],
            'group_code' => $data['group_id'],
            'amount' => is_array($data['amount']) ? array_sum($data['amount']) : 0,
        ]);

        $encryptedUrl = $this->initiatePayment($dataArray);

        return response()->json(['status' => Constant::SUCCESS, 'encryptedUrl' => $encryptedUrl]);
    }

    public function initiatePayment($dataArray = [])
    {
        $aesKey = "3900341616701060";
        $subMerchantId = "45";
        $merchantId = "391678";

        $dataArray['amount'] = 1;
        $dataArray['email'] = "devsofthought@gmail.com";
        $dataArray['mobile_no'] = "7003319369";

        try {
            DB::beginTransaction();

            $serialMaster = DB::table('serialmaster')->where('moduleTag', 'TR')->first();
            $transaction_id = $serialMaster->module . sprintf('%05d', $serialMaster->lastnumber);
            $dataArray['transaction_number'] = $transaction_id;

            $mandatoryFields = [
                $transaction_id,
                $subMerchantId,
                $dataArray['amount'],
                $dataArray['member_code'],
                $dataArray['member_name'],
            ];

            $optionalFields = [
                $dataArray['mobile_no'],
                $dataArray['email'],
                $dataArray['programme_code'],
                $dataArray['group_code'],
            ];

            // ✅ Encrypt each block
            $encryptedMandatoryFields = $this->aes128Encrypt(implode('|', $mandatoryFields), $aesKey);
            $encryptedOptionalFields = $this->aes128Encrypt(implode('|', $optionalFields), $aesKey);
            $encryptedReturnUrl = $this->aes128Encrypt('https://members.btaportal.in/payment-response', $aesKey);
            $encryptedReferenceNo = $this->aes128Encrypt($transaction_id, $aesKey);
            $encryptedSubMerchantId = $this->aes128Encrypt($subMerchantId, $aesKey);
            $encryptedAmount = $this->aes128Encrypt($dataArray['amount'], $aesKey);
            $encryptedPayMode = $this->aes128Encrypt('9', $aesKey);

            // ✅ Construct correct final encrypted URL (no spaces in keys!)
            $encryptedUrl = "https://eazypay.icicibank.com/EazyPG?"
                . "merchantid=" . $merchantId
                . "&mandatory fields=" . $encryptedMandatoryFields
                . "&optional fields=" . $encryptedOptionalFields
                . "&returnurl=" . $encryptedReturnUrl
                . "&Reference No=" . $encryptedReferenceNo
                . "&submerchantid=" . $encryptedSubMerchantId
                . "&transaction amount=" . $encryptedAmount
                . "&paymode=" . $encryptedPayMode;

            // Build plain values for storage
            $plainMandatoryFields = implode('|', $mandatoryFields);
            $plainOptionalFields = implode('|', $optionalFields);
            $plainReturnUrl = 'https://members.btaportal.in/payment-response';
            $plainReferenceNo = $transaction_id;
            $plainSubMerchantId = $subMerchantId;
            $plainAmount = $dataArray['amount'];
            $plainPayMode = '9';

            // Build plain URL for storage
            $plainUrl = "https://eazypay.icicibank.com/EazyPG?"
                . "merchantid=" . $merchantId
                . "&mandatory fields=" . $plainMandatoryFields
                . "&optional fields=" . $plainOptionalFields
                . "&returnurl=" . $plainReturnUrl
                . "&Reference No=" . $plainReferenceNo
                . "&submerchantid=" . $plainSubMerchantId
                . "&transaction amount=" . $plainAmount
                . "&paymode=" . $plainPayMode;



            DB::table('payment_request')->insert([
                'transaction_id' => $transaction_id,
                'order_id' => sha1($transaction_id),
                'paymeny_for' => 'Fees Payments',
                'payment_geteway' => 'Eazypay',
                'amount' => $dataArray['amount'],
                'enc_request' => $encryptedUrl,
                'plain_request' => $plainUrl,
                'payment_session_data' => json_encode($dataArray),
            ]);

            DB::table('serialmaster')
                ->where('moduleTag', 'TR')
                ->update(['lastnumber' => $serialMaster->lastnumber + 1]);

            DB::commit();

            return $encryptedUrl;
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }


    public function paymentResponse(Request $request)
    {
        try {
            DB::beginTransaction();

            $referenceNo = $request->post('ReferenceNo');
            $bankRefNo = $request->post('Unique_Ref_Number');

            $paymentRequestModel = PaymentRequest::where('transaction_id', $referenceNo)->first();

            $paymentStatus = $request->post('Response_Code') === "E000" ? true : false;

            $paymentResponseModel = PaymentResponse::updateOrCreate(
                ['transaction_id' => $paymentRequestModel->id],
                [
                    'order_id' => $paymentRequestModel->order_id,
                    'payment_status' => $paymentStatus ? "Y" : "N",
                    'processing_date' => now(),
                    'tracking_id' => $referenceNo,
                    'bank_ref_no' => $bankRefNo,
                    'payment_geteway' => 'Eazypay',
                    'response_data' => json_encode($request->all()),
                    'payment_message' => $this->getResponseMessage($request->post('Response_Code')),
                ]
            );

            $paymentRequestModel->status = $paymentStatus ? 'Y' : 'N';
            $paymentRequestModel->save();

            if ($paymentStatus) {
                $sessionData = json_decode($paymentRequestModel->payment_session_data, true);
                processPayment($sessionData, $paymentRequestModel, $bankRefNo);
            }

            DB::commit();

            return redirect()->to('response')
                ->with('message', $referenceNo)
                ->with('status', $paymentStatus ? 'success' : 'error');

        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
    }

    public function response()
    {
        $data['bodyView'] = view('payment-response');
        return $this->renderView($data);
    }

    public function aes128Encrypt($str, $key)
    {
        $plaintext = $str;
        $cipher = "aes-128-ecb";
        in_array($cipher, openssl_get_cipher_methods(true));
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes(1);
        $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options = 0, "");
        return $ciphertext;
    }

    private function getResponseMessage($code)
    {

        $errorCodeConstant = [
            'E000' => 'Received successful confirmation in real time for the transaction. Settlement process is initiated for the transaction.',
            'E001' => 'Unauthorized Payment Mode',
            'E002' => 'Unauthorized Key',
            'E003' => 'Unauthorized Packet',
            'E004' => 'Unauthorized Merchant',
            'E005' => 'Unauthorized Return URL',
            'E006' => 'Transaction is already paid',
            'E007' => 'Transaction Failed',
            'E008' => 'Failure from Third Party due to Technical Error',
            'E009' => 'Bill Already Expired',
            'E0031' => 'Mandatory fields coming from merchant are empty',
            'E0032' => 'Mandatory fields coming from database are empty',
            'E0033' => 'Payment mode coming from merchant is empty',
            'E0034' => 'PG Reference number coming from merchant is empty',
            'E0035' => 'Sub merchant id coming from merchant is empty',
            'E0036' => 'Transaction amount coming from merchant is empty',
            'E0037' => 'Payment mode coming from merchant is other than 0 to 9',
            'E0038' => 'Transaction amount coming from merchant is more than 9 digit length',
            'E0039' => 'Mandatory value Email in wrong format',
            'E00310' => 'Mandatory value mobile number in wrong format',
            'E00311' => 'Mandatory value amount in wrong format',
            'E00312' => 'Mandatory value Pan card in wrong format',
            'E00313' => 'Mandatory value Date in wrong format',
            'E00314' => 'Mandatory value String in wrong format',
            'E00315' => 'Optional value Email in wrong format',
            'E00316' => 'Optional value mobile number in wrong format',
            'E00317' => 'Optional value amount in wrong format',
            'E00318' => 'Optional value pan card number in wrong format',
            'E00319' => 'Optional value date in wrong format',
            'E00320' => 'Optional value string in wrong format',
            'E00321' => 'Request packet mandatory columns is not equal to mandatory columns set in enrolment or optional columns are not equal to optional columns length set in enrolment',
            'E00322' => 'Reference Number Blank',
            'E00323' => 'Mandatory Columns are Blank',
            'E00324' => 'Merchant Reference Number and Mandatory Columns are Blank',
            'E00325' => 'Merchant Reference Number Duplicate',
            'E00326' => 'Sub merchant id coming from merchant is non numeric',
            'E00327' => 'Cash Challan Generated',
            'E00328' => 'Cheque Challan Generated',
            'E00329' => 'NEFT Challan Generated',
            'E00330' => 'Transaction Amount and Mandatory Transaction Amount mismatch in Request URL',
            'E00331' => 'UPI Transaction Initiated Please Accept or Reject the Transaction',
            'E00332' => 'Challan Already Generated, Please re-initiate with unique reference number',
            'E00333' => 'Referer is null/invalid Referer',
            'E00334' => 'Mandatory Parameters Reference No and Request Reference No parameter values are not matched',
            'E00335' => 'Transaction Cancelled By User',
            'E0801' => 'FAIL',
            'E0802' => 'User Dropped',
            'E0803' => 'Canceled by user',
            'E0804' => 'User Request arrived but card brand not supported',
            'E0805' => 'Checkout page rendered Card function not supported',
            'E0806' => 'Forwarded / Exceeds withdrawal amount limit',
            'E0807' => 'PG Fwd Fail / Issuer Authentication Server failure',
            'E0808' => 'Session expiry / Failed Initiate Check, Card BIN not present',
            'E0809' => 'Reversed / Expired Card',
            'E0810' => 'Unable to Authorize',
            'E0811' => 'Invalid Response Code or Guide received from Issuer',
            'E0812' => 'Do not honor',
            'E0813' => 'Invalid transaction',
            'E0814' => 'Not Matched with the entered amount',
            'E0815' => 'Not sufficient funds',
            'E0816' => 'No Match with the card number',
            'E0817' => 'General Error',
            'E0818' => 'Suspected fraud',
            'E0819' => 'User Inactive',
            'E0820' => 'ECI 1 and ECI6 Error for Debit Cards and Credit Cards',
            'E0821' => 'ECI 7 for Debit Cards and Credit Cards',
            'E0822' => 'System error. Could not process transaction',
            'E0823' => 'Invalid 3D Secure values',
            'E0824' => 'Bad Track Data',
            'E0825' => 'Transaction not permitted to cardholder',
            'E0826' => 'Rupay timeout from issuing bank',
            'E0827' => 'OCEAN for Debit Cards and Credit Cards',
            'E0828' => 'E-commerce decline',
            'E0829' => 'This transaction is already in process or already processed',
            'E0830' => 'Issuer or switch is inoperative',
            'E0831' => 'Exceeds withdrawal frequency limit',
            'E0832' => 'Restricted card',
            'E0833' => 'Lost card',
            'E0834' => 'Communication Error with NPCI',
            'E0835' => 'The order already exists in the database',
            'E0836' => 'General Error Rejected by NPCI',
            'E0837' => 'Invalid credit card number',
            'E0838' => 'Invalid amount',
            'E0839' => 'Duplicate Data Posted',
            'E0840' => 'Format error',
            'E0841' => 'SYSTEM ERROR',
            'E0842' => 'Invalid expiration date',
            'E0843' => 'Session expired for this transaction',
            'E0844' => 'FRAUD - Purchase limit exceeded',
            'E0845' => 'Verification decline',
            'E0846' => 'Compliance error code for issuer',
            'E0847' => 'Caught ERROR of type:[ System.Xml.XmlException ] . strXML is not a valid XML string Failed in Authorize - I',
            'E0848' => 'Incorrect personal identification number',
            'E0849' => 'Stolen card',
            'E0850' => 'Transaction timed out, please retry',
            'E0851' => 'Failed in Authorization - PE',
            'E0852' => 'Cardholder did not return from Rupay',
            'E0853' => 'Missing Mandatory Field(s)The field card_number has exceeded the maximum length of 19',
            'E0854' => 'Exception in CheckEnrollmentStatus: Data at the root level is invalid. Line 1, position 1.',
            'E0855' => 'CAF status = 0 or 9',
            'E0856' => '412',
            'E0857' => 'Allowable number of PIN tries exceeded',
            'E0858' => 'No such issuer',
            'E0859' => 'Invalid Data Posted',
            'E0860' => 'PREVIOUSLY AUTHORIZED',
            'E0861' => 'Cardholder did not return from ACS',
            'E0862' => 'Duplicate transmission',
            'E0863' => 'Wrong transaction state',
            'E0864' => 'Card acceptor contact acquirer',
        ];

        return $errorCodeConstant[$code];
    }
}
