<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class PaymentMaster extends BaseModel
{
    use HasFactory;
    protected $table = 'payment_master';

    public function receipt()
    {
        return $this->belongsTo(MemberReceiptMaster::class, 'receipt_master_id');
    }

    public function scopeGetEnrollmentReceiptGST($query, $enrollment_id)
    {
        $components = DB::table('payment_master AS PM')
            ->select('PCC.*', 'MRD.*')
            ->leftJoin('payment_details AS PD', 'PD.payment_master_id', '=', 'PM.payment_id')
            ->leftJoin('member_receipt_master AS MRM', 'MRM.receipt_id', '=', 'PM.receipt_master_id')
            ->leftJoin('member_receipt_details AS MRD', 'MRD.receipt_master_id', '=', 'MRM.receipt_id')
            ->leftJoin('payment_mode_details AS PMD', 'PMD.id', '=', 'PD.payment_mode_id')
            ->leftJoin('programme_commercial_component AS PCC', 'PCC.component_id', '=', 'MRD.component_id')
            ->leftJoin('member_master AS MM', 'MM.member_id', '=', 'PM.member_id')
            ->where('PM.enrollment_id', $enrollment_id)
            ->where('PM.is_gst_bill', 'Y')
            ->whereNotNull('PCC.component_id')
            ->groupBy('PCC.component_id')
            ->get();

        $data = [];
        foreach ($components as $value) {
            $data[] = [
                "Description" => $value->description,
                "PaymentData" => $this->GetEnrollmentReceiptGSTByEnrollment($enrollment_id)
            ];
        }

        return $data;
    }

    public function GetEnrollmentReceiptGSTByEnrollment($enrollment_id)
    {
        $result = DB::table('payment_master AS PM')
            ->select(
                'PM.*',
                'PD.*',
                'MRM.*',
                'MRD.*',
                'PMD.*',
                'PCC.*',
                'MM.*',
                'MRM.is_active AS IsActive',
                'MRM.inactive_by AS InActiveBy',
                'MRM.inactive_date AS InActiveDate',
                'MRM.inactive_note AS InActiveNote',
                'users.name AS cancelledBy'
            )
            ->leftJoin('payment_details AS PD', 'PD.payment_master_id', '=', 'PM.payment_id')
            ->leftJoin('member_receipt_master AS MRM', 'MRM.receipt_id', '=', 'PM.receipt_master_id')
            ->leftJoin('member_receipt_details AS MRD', 'MRD.receipt_master_id', '=', 'MRM.receipt_id')
            ->leftJoin('payment_mode_details AS PMD', 'PMD.id', '=', 'PD.payment_mode_id')
            ->leftJoin('programme_commercial_component AS PCC', 'PCC.component_id', '=', 'MRD.component_id')
            ->leftJoin('member_master AS MM', 'MM.member_id', '=', 'PM.member_id')
            ->leftJoin('users', 'users.id', '=', 'MRM.inactive_by')
            ->where('PM.enrollment_id', $enrollment_id)
            ->where('PM.is_gst_bill', 'Y')
            ->first();

        return $result;
    }

}
