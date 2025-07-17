<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function payment()
    {
        $dataArray = [
            'pan_no' => 'ABC1234567',
            'full_name' => 'John Doe',
            'date_of_birth' => '1990-01-01',
            'address' => '123 Main St, City, State, Zip',
            'mobile_no' => '1234567890',
            'email' => 'abc@gmail.com',
            'donation_amount' => 1,
            'request_id' => rand(100000, 999999)
        ];

        $url = $this->initiatePayment($dataArray);

        return "
            <script>
                    window.location.href = '$url';
            </script>
        ";
    }

    public function initiatePayment($dataArray = [])
    {
        $aesKey = "3900341616701060";
        $subMerchantId = "45";
        $marchentId = "391678";

        try {
            DB::beginTransaction();

            $serialMaster = DB::table('serialmaster')->where('moduleTag', 'TR')->first();
            $transaction_id = $serialMaster->module . sprintf('%05d', $serialMaster->lastnumber);
            array_merge($dataArray, [
                'transaction_number' => $transaction_id,
            ]);

            $mandatoryFields = [
                $transaction_id,
                $subMerchantId,
                $dataArray['donation_amount'],
                $dataArray['full_name'],
                $dataArray['mobile_no'],
                $dataArray['email'],
                $dataArray['address'] ?? 'kolkata'
            ];

            // Encrypt each section
            $encryptedMandatoryFields = $this->aes128Encrypt(implode('|', $mandatoryFields), $aesKey);
            $encryptedReturnUrl = $this->aes128Encrypt('https://members.btaportal.in', $aesKey);
            $encryptedReferenceNo = $this->aes128Encrypt($mandatoryFields[0], $aesKey);
            $encryptedSubMerchantId = $this->aes128Encrypt($mandatoryFields[1], $aesKey);
            $encryptedAmount = $this->aes128Encrypt($mandatoryFields[2], $aesKey);
            $encryptedPayMode = $this->aes128Encrypt('9', $aesKey);

            // Construct final encrypted URL
            $encryptedUrl = "https://eazypay.icicibank.com/EazyPG?merchantid="
                . $marchentId
                . "&mandatory fields=" . $encryptedMandatoryFields
                . "&optional fields="
                . "&returnurl=" . $encryptedReturnUrl
                . "&Reference No=" . $encryptedReferenceNo
                . "&submerchantid=" . $encryptedSubMerchantId
                . "&transaction amount=" . $encryptedAmount
                . "&paymode=" . $encryptedPayMode;

            DB::table('payment_request')->insertGetId([
                'transaction_id' => $transaction_id,
                'order_id' => $dataArray['request_id'],
                'paymeny_for' => 'Donation',
                'payment_geteway' => 'Eazypay',
                'amount' => $dataArray['donation_amount'],
                'enc_request' => $encryptedUrl,
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
        pre($request->all());
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
}
