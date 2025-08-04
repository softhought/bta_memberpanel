<?php

use App\Models\LogTable;
use App\Models\Member;
use App\Models\MemberReceiptDetail;
use App\Models\MemberReceiptMaster;
use App\Models\Menu;
use App\Models\PaymentDetails;
use App\Models\PaymentMaster;
use App\Models\PaymentMode;
use App\Models\PaymentRequest;
use App\Models\PaymentResponse;
use App\Models\VoucherDetails;
use App\Models\VoucherMaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use PhpOffice\PhpSpreadsheet\IOFactory;

function getTopNavCat($roleId, $baseUrl = "")
{
    $menus = Menu::parents($roleId)->with('childrenRecursive')->get()->toArray();
    return generateMenuHtml($menus, 0, $baseUrl);
}

if (!function_exists('getBadgeColor')) {
    function getBadgeColor($level)
    {
        switch ($level) {
            case 0:
                return 'primary';   // Parent
            case 1:
                return 'level-success';   // Level 1
            case 2:
                return 'level-info';      // Level 2
            case 3:
                return 'level-warning';   // Level 3
            case 4:
                return 'level-danger';    // Level 4
            case 5:
                return 'level-dark';      // Level 5
            case 6:
                return 'level-light';     // Level 6
            case 7:
                return 'level-secondary'; // Level 7
            case 8:
                return 'level-muted';     // Level 8
            case 9:
                return 'level-dark';     // Level 9
            default:
                return 'level-default';   // Default for Level 10 or deeper
        }

    }
}

function generateMenuHtml($menus, $level, $baseUrl)
{
    $html = '';

    // Start the unordered list for the first level

    foreach ($menus as $item) {
        // Determine if the current item or its children are active
        $isOpen = request()->is($baseUrl . $item['url']) || isActiveChildMenu($item['children_recursive'], $baseUrl);
        $isActive = request()->is($baseUrl . $item['url']) || isActiveChildMenu($item['children_recursive'], $baseUrl);

        // Render the menu item with potential children
        if (count($item['children_recursive']) > 0) {
            $html .= '<li class="' . ($isOpen ? 'active' : '') . ' ' . ($isActive ? 'selected' : '') . '">';
            $html .= '<a href="javascript:void(0);" class="has-arrow" aria-expanded="' . ($isOpen ? 'true' : 'false') . '">';
            $html .= '<span class="has-icon">' . $item['icon'] . '</span>';
            $html .= '<span class="nav-title">' . $item['name'] . '</span>';
            // $html .= '<span class="lbl"></span>';
            $html .= '</a>';
            $html .= '<ul aria-expanded="' . ($isOpen ? 'true' : 'false') . '" class="' . ($isOpen ? 'collapse in' : 'collapse') . '">';
            $html .= generateMenuHtml($item['children_recursive'], $level + 1, $baseUrl);
            $html .= '</ul>';
        } else {
            // Single-level menu item
            $html .= '<li class="' . ($isActive ? 'selected active' : '') . '">';
            $html .= '<a href="' . url($baseUrl . $item['url']) . '">';
            $html .= '<span class="' . ($level > 0 ? 'has-icon-sub' : 'has-icon') . '">' . $item['icon'] . '</span>';
            $html .= '<span class="nav-title">' . $item['name'] . '</span>';
            $html .= '</a>';
            $html .= '</li>'; // Closing the single-level item
        }
    }

    return $html;
}

function isActiveChildMenu($children, $baseUrl)
{
    foreach ($children as $item) {
        if (request()->is($baseUrl . $item['url']) || isActiveChildMenu($item['children_recursive'], $baseUrl)) {
            return true;
        }
    }

    return false;
}


if (!function_exists('getUserBrowserName')) {
    function getUserBrowserName()
    {
        $agent = new Agent();
        $browserName = $agent->browser();
        return $browserName;

    }
}

if (!function_exists('getUserPlatform')) {
    function getUserPlatform()
    {
        $agent = new Agent();
        $platform = $agent->platform();
        return $platform;

    }
}

if (!function_exists('getUserIPAddress')) {
    function getUserIPAddress()
    {
        $agent = new Agent();
        $ipAddress = request()->ip();
        return $ipAddress;

    }
}

if (!function_exists('getIpAddress')) {
    function getIpAddress()
    {
        return request()->ip();
    }
}


function getMenuTree($userId)
{
    $menus = Menu::parents($userId)->with('childrenRecursive')->get();
    return generateMenuTree($menus, 0);
}

function generateMenuTree($menus, $level)
{

    $html = '';
    if ($level == 1) {
        $html .= '<ul>';
    }

    foreach ($menus as $item) {
        $html .= '<li id="' . $item['id'] . '">' . $item['name'];
        $html .= generateMenuTree($item['children'], 1);
        $html .= '</li>';
    }
    if ($level == 1) {
        $html .= '</ul>';
    }

    return $html;
}

function getEditData($mode, $arrayData, $filled, $imagePath = "")
{
    $value = "";
    if ($mode == "Edit" && !empty($arrayData)) {
        $value = $arrayData->$filled;
        if ($imagePath != "" && $arrayData->$filled != "") {
            $value = $imagePath . "/" . $arrayData->$filled;
        }
    }
    return $value;
}

function getEditDate($mode, $arrayData, $filled)
{
    $value = "";
    if ($mode == "Edit" && !empty($arrayData)) {
        $value = date_dmy_dp($arrayData->$filled);

    }
    return $value;
}

if (!function_exists('excelToArray')) {
    function excelToArray($file)
    {
        $path = $file->getPathname();
        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [];

        foreach ($sheet->getRowIterator(1)->current()->getCellIterator() as $cell) {
            $header = $cell->getValue();
            $header = str_replace(' ', '_', $header);
            $headers[] = $header;
        }

        $data = [];

        if ($sheet->getHighestRow() > 1) {
            foreach ($sheet->getRowIterator(2) as $row) {
                $rowData = [];

                foreach ($row->getCellIterator() as $cell) {
                    $value = $cell->getValue();
                    $rowData[] = $value;
                }

                if (array_filter($rowData, fn($value) => $value !== null && $value !== '') == []) {
                    continue;
                }

                $rowKeyValue = array_combine($headers, array_map('strval', $rowData));
                $data[] = $rowKeyValue;
            }
        }

        return (object) $data;
    }
}
if (!function_exists('validateData')) {
    function validateData($data, $table, $uniqueFields = [], $fieldRules = [], $fieldMapping = [], $dbChecks = [])
    {
        $errorArray = [];
        foreach ($data as $row => $value) {
            // Check for unique fields
            foreach ($uniqueFields as $field) {
                // Map to the database field if a mapping exists
                $dbField = $fieldMapping[$field] ?? $field;

                if (!empty($value[$field])) {
                    // Check uniqueness in the database using the mapped field
                    $rowData = DB::table($table)->where($dbField, $value[$field])->first();
                    if ($rowData) {
                        $errorArray[] = ['row' => $row, 'col' => [$field]];
                    }
                }
            }

            // Check for any database existence checks
            foreach ($dbChecks as $field => $dbCheck) {
                if (!empty($value[$field])) {
                    $exists = DB::table($dbCheck['table'])->where([$dbCheck['column'] => $value[$field], 'is_active' => 'Y'])->exists();
                    if (!$exists) {
                        $errorArray[] = ['row' => $row, 'col' => [$field]];
                    }
                }
            }

            // Validate fields based on provided rules
            foreach ($fieldRules as $field => $rule) {
                if (!empty($value[$field]) && !preg_match($rule, $value[$field])) {
                    $errorArray[] = ['row' => $row, 'col' => [$field]];
                }
            }

            // Check for empty required fields
            $emptyCols = [];
            foreach (array_keys($fieldRules) as $field) {
                if (empty($value[$field])) {
                    $emptyCols[] = $field;
                }
            }

            if (!empty($emptyCols) && count($emptyCols) != count($fieldRules)) {
                $errorArray[] = ['row' => $row, 'col' => $emptyCols];
            }
        }

        return $errorArray;
    }

}


function arrConvertToAssociativeJsonObject($data)
{
    return json_decode(json_encode($data), true);
}

function insertLog($model, $mode = 'Add')
{
    $table = $model->getTable();
    $data = $model->toArray();
    $insertedId = $model->id;

    switch ($mode) {
        case 'Edit':
            $logType = config('constants.LOG_U');
            break;
        case 'Delete':
            $logType = config('constants.LOG_D');
            break;
        default:
            $logType = config('constants.LOG_I');
            break;
    }


    LogTable::insertLogData($table, $data, $insertedId, $logType);
}


function makeReadable($text)
{
    $readableText = ucwords(str_replace('_', ' ', str_replace('-', ' ', $text)));
    return $readableText;
}


function getFileCategory($extension)
{
    $extension = strtolower($extension);

    $categories = [
        'EXCEL' => ['xls', 'xlsx', 'xlsm', 'xlsb', 'csv', 'xlt', 'xltx', 'xltm', 'xml'],
        'WORD' => ['doc', 'docx', 'dot', 'dotx', 'rtf'],
        'PDF' => ['pdf'],
        'IMAGE' => ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'tiff'],
        'OTHER' => []
    ];

    foreach ($categories as $category => $extensions) {
        if (in_array($extension, $extensions)) {
            return $category;
        }
    }

    return 'OTHER';
}


if (!function_exists('getInitials')) {
    function getInitials($name)
    {
        $parts = explode(' ', $name);
        $initials = '';

        foreach ($parts as $part) {
            if (!empty($part)) {
                $initials .= strtoupper(substr($part, 0, 1));
            }
        }

        return strtoupper(substr($initials, 0, 3));
    }
}

function processDailyCollectionData($paymentMstId)
{
    try {
        // Step 1: Delete existing records
        DB::table('daily_collection_report')->where('payment_master_id', $paymentMstId)->delete();

        // Step 2: Retrieve payment data
        $paymentMasterData = DB::table('payment_master')->where('payment_id', $paymentMstId)->get();

        if ($paymentMasterData->isEmpty()) {
            return false;
        }

        foreach ($paymentMasterData as $payment) {
            // Step 3: Calculate payment amount
            $paymentAmount = $payment->round_off_amount > 0
                ? $payment->payment_amount - $payment->round_off_amount - $payment->total_bank_charges
                : $payment->payment_amount + $payment->round_off_amount - $payment->total_bank_charges;

            // Step 4: Fetch member receipt master
            $memberReceiptMaster = DB::table('member_receipt_master')
                ->where('receipt_id', $payment->receipt_master_id)
                ->first();

            if (!empty($memberReceiptMaster) && $memberReceiptMaster->adjust_amount > 0) {
                DB::table('daily_collection_report')->insert([
                    'payment_master_id' => $payment->payment_id,
                    'component_id' => 42,
                    'amount' => $memberReceiptMaster->adjust_amount,
                    'is_adjust' => 'Y',
                ]);

                $paymentAmount -= $memberReceiptMaster->adjust_amount;
            }

            // Step 5: Fetch member receipt details
            $memberReceiptDetails = DB::table('member_receipt_details')
                ->select(DB::raw('SUM(net_amount) as net_amount, component_id'))
                ->where('receipt_master_id', $payment->receipt_master_id)
                ->groupBy('component_id')
                ->get();

            foreach ($memberReceiptDetails as $detail) {
                if ($paymentAmount <= 0)
                    break;

                if ($paymentAmount <= $detail->net_amount) {
                    DB::table('daily_collection_report')->insert([
                        'payment_master_id' => $payment->payment_id,
                        'component_id' => $detail->component_id,
                        'amount' => $paymentAmount,
                    ]);
                    $paymentAmount = 0;
                } else {
                    DB::table('daily_collection_report')->insert([
                        'payment_master_id' => $payment->payment_id,
                        'component_id' => $detail->component_id,
                        'amount' => $detail->net_amount,
                    ]);
                    $paymentAmount -= $detail->net_amount;
                }
            }

            if ($paymentAmount > 0) {
                DB::table('daily_collection_report')->insert([
                    'payment_master_id' => $payment->payment_id,
                    'component_id' => 42,
                    'amount' => $paymentAmount,
                ]);
            }
        }

        return true;
    } catch (Exception $e) {
        return false;
    }
}


function processPayment($sessionData, $paymentRequestModel, $bankCharges = 0)
{
    $yearId = DB::table('financialyear')->where('is_active', 'Y')->orderByDesc('year_id')->first()->year_id;

    // Create Receipt Master
    $memberReceiptMasterModel = MemberReceiptMaster::updateOrCreate(
        ['reference_no' => $paymentRequestModel->id, 'receipt_no' => generateReceiptNo($paymentRequestModel->id)],
        [
            'receipt_date' => date('Y-m-d'),
            'no_of_months' => count($sessionData['month_id']),
            'total_amount' => array_sum($sessionData['payable']),
            'total_discount' => 0,
            'total_taxable_amount' => array_sum($sessionData['payable']),
            'total_cgst_amount' => 0,
            'total_sgst_amount' => 0,
            'total_gst_amount' => 0,
            'adjust_amount' => 0,
            'net_payble_amount' => array_sum($sessionData['payable']),
            'year_id' => $yearId,
            'company_id' => 1,
            'user_id' => 12,
            'entry_from' => 'M',
            'bill_type' => 'NONGST',
            'is_general_receipt' => 'N',
            'is_active' => 'Y',
            'is_wave_receipt' => 'N',
            'active_programme_group' => $sessionData['group_id']
        ]
    );

    // Create Receipt Details
    foreach ($sessionData['month_id'] as $key => $monthId) {
        $crAccountId = DB::table('programme_commercial_component')
            ->where('component_id', $sessionData['component_id'][$key])
            ->value('account_id');

        $memberReceiptDetailModel = MemberReceiptDetail::updateOrCreate(
            [
                'receipt_master_id' => $memberReceiptMasterModel->receipt_id,
                'year' => date('Y'),
                'month_id' => $monthId,
            ],
            [
                'cr_ac_id' => $crAccountId,
                'component_id' => $sessionData['component_id'][$key],
                'item_amount' => $sessionData['payable'][$key],
                'item_qty' => 1,
                'amount' => $sessionData['payable'][$key],
                'discount' => 0,
                'taxable_amount' => $sessionData['payable'][$key],
                'cgst_id' => 0,
                'sgst_id' => 0,
                'cgst_amount' => 0,
                'sgst_amount' => 0,
                'total_gst_amount' => 0,
                'is_payment_due' => "N",
                'due_amount' => 0,
                'net_amount' => $sessionData['payable'][$key],
                'is_waiver' => "N",
            ]
        );
    }

    // Create Voucher Master
    $voucherMasterModel = VoucherMaster::updateOrCreate(
        ['voucher_no' => $memberReceiptMasterModel->receipt_no],
        [
            'voucher_date' => date('Y-m-d'),
            'tran_type' => 'ONLINE',
            'narration' => "Payment From Student " . date("d/m/Y"),
            'total_dr_amt' => $memberReceiptMasterModel->net_payble_amount,
            'total_cr_amt' => $memberReceiptMasterModel->net_payble_amount,
            'user_id' => 12,
            'year_id' => $yearId,
            'company_id' => 1,
            'reference_no' => $paymentRequestModel->id
        ]
    );

    // Create Voucher Details
    $paymentModeDetails = PaymentMode::where('payment_mode', 'ICICI Payment Gateway')->first();

    $voucherDetailCrModel = VoucherDetails::updateOrCreate(
        ['voucher_master_id' => $voucherMasterModel->id, 'tran_tag' => 'Cr'],
        [
            'account_master_id' => $crAccountId,
            'amount' => $memberReceiptMasterModel->net_payble_amount,
            'srl_no' => 1
        ]
    );

    $voucherDetailDrModel = VoucherDetails::updateOrCreate(
        ['voucher_master_id' => $voucherMasterModel->id, 'tran_tag' => 'Dr'],
        [
            'account_master_id' => $paymentModeDetails->account_id,
            'amount' => $memberReceiptMasterModel->net_payble_amount,
        ]
    );

    // Create Payment Master
    $paymentMasterModel = PaymentMaster::updateOrCreate(
        ['receipt_master_id' => $memberReceiptMasterModel->receipt_id],
        [
            'member_id' => $sessionData['member_id'],
            'enrollment_id' => $sessionData['enrollment_id'],
            'voucher_id' => $voucherMasterModel->id,
            'payment_no' => $memberReceiptMasterModel->receipt_no,
            'payment_date' => date('Y-m-d'),
            'total_payble_amount' => $memberReceiptMasterModel->net_payble_amount + $bankCharges,
            'payment_amount' => $memberReceiptMasterModel->net_payble_amount + $bankCharges,
            'short_excess_cr_ac_id' => 23,
            'short_excess_amount' => 0,
            'company_id' => 1,
            'year_id' => $yearId,
            'round_off_account_id' => 30,
            'round_off_amount' => 0,
            'is_gst_bill' => 'N',
            'total_bank_charges' => $bankCharges,
        ]
    );

    // Create Payment Detail
    $paymentDetailModel = PaymentDetails::updateOrCreate(
        [
            'payment_master_id' => $paymentMasterModel->payment_id,
            'payment_mode_id' => $paymentModeDetails->id
        ],
        [
            'dr_account_id' => $paymentModeDetails->account_id,
            'amount' => $memberReceiptMasterModel->net_payble_amount + $bankCharges,
            'cheque_date' => date('Y-m-d'),
            'bank_charges' => $bankCharges,
            'payment_ref' => $paymentRequestModel->id
        ]
    );

    // Create Daily Collection Report
    processDailyCollectionData($paymentMasterModel->payment_id);

    // --- SMS Sending ---
    $member = Member::find($sessionData['member_id']);
    if (!empty($member->primary_mobile)) {
        $smsMessage = "Received Fees payment of Rs. {$paymentMasterModel->payment_amount} from Student's Name {$member->member_fname} {$member->member_lname} on date {$paymentMasterModel->payment_date}. Bengal Tennis Association";

        $smsPayload = [
            "api_key" => "67ed0ad1d0300512e4fb2b6a96f4c262",
            "msg" => $smsMessage,
            "senderid" => "BTASMS",
            "templateID" => "1707175411804178921",
            "coding" => "1",
            "to" => $member->primary_mobile,
            "callbackData" => "cb"
        ];

        try {
            $smsResponse = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Key 67ed0ad1d0300512e4fb2b6a96f4c262',
            ])->post('https://smscannon.com/api/api.php', $smsPayload);

            $smsResult = $smsResponse->json();
        } catch (Exception $e) {

        }
    }

    return ['receipt_id' => $memberReceiptMasterModel->receipt_id, 'payment_id' => $paymentMasterModel->payment_id];
}

function generateReceiptNo($transactionId)
{
    $yearId = DB::table('financialyear')
        ->where('is_active', 'Y')
        ->orderByDesc('year_id')
        ->first()
        ->year_id;

    $existingReceiptNo = DB::table('member_receipt_master')
        ->where('reference_no', $transactionId)
        ->value('receipt_no');

    if ($existingReceiptNo) {
        return $existingReceiptNo;
    }

    return DB::transaction(function () use ($yearId) {
        do {
            $serialMaster = DB::table('serialmaster')
                ->where('moduleTag', 'NGST')
                ->where('year_id', $yearId)
                ->lockForUpdate()
                ->first();

            $receiptNo = $serialMaster->moduleTag . '/' . sprintf('%05d', $serialMaster->serial) . '/' . $serialMaster->year_tag;

            $exists = DB::table('member_receipt_master')
                ->where('receipt_no', $receiptNo)
                ->exists();

            if (!$exists) {
                DB::table('serialmaster')
                    ->where('moduleTag', 'NGST')
                    ->where('year_id', $yearId)
                    ->update(['serial' => $serialMaster->serial + 1]);

                return $receiptNo;
            } else {
                DB::table('serialmaster')
                    ->where('moduleTag', 'NGST')
                    ->where('year_id', $yearId)
                    ->update(['serial' => $serialMaster->serial + 1]);
            }

        } while (true);
    });
}

function checkEazypayTransaction($pgReferenceNo)
{
    $merchantId = '391678';

    $url = "https://eazypay.icicibank.com/EazyPGVerify?merchantid={$merchantId}&pgreferenceno={$pgReferenceNo}";

    $response = Http::get($url);
    $result = [];
    parse_str($response->body(), $result);

    return $result;
}

function processPendingPayments()
{
    $pendingRequest = PaymentRequest::where('status', 'N')->where('is_checking', 'N')->get();

    foreach ($pendingRequest as $value) {
        DB::beginTransaction();

        try {
            $response = checkEazypayTransaction($value->transaction_id);

            $status = strtolower(trim($response['status']));
            if (in_array($status, ['rip', 'sip', 'success'])) {

                $paymentResponseModel = PaymentResponse::updateOrCreate(
                    ['transaction_id' => $value->id],
                    [
                        'order_id' => $value->order_id,
                        'payment_status' => "Y",
                        'processing_date' => now(),
                        'tracking_id' => $value->transaction_id,
                        'bank_ref_no' => $response['ezpaytranid'],
                        'payment_geteway' => 'Eazypay',
                        'response_data' => json_encode($response),
                        'payment_message' => "Payment Successful",
                    ]
                );

                $value->status = 'Y';
                $value->is_checking = 'Y';
                $value->save();

                $sessionData = json_decode($value->payment_session_data, true);

                $bankCharges = (float) $response['amount'] - (float) $sessionData['payable'];
                echo $sessionData['payable'];exit;
                processPayment($sessionData, $value, $bankCharges);
            } else {
                PaymentRequest::where('id', $value->id)->update(['is_checking' => 'Y']);
            }
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Payment processing failed for transaction_id: {$value->transaction_id}", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
