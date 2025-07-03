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

    public function scopeGetEnrollmentReceiptGSTByEnrollment($query, $enrollmentId)
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
            ->where('PM.enrollment_id', $enrollmentId)
            ->where('PM.is_gst_bill', 'Y')
            ->get();

        return $result;
    }

    public function scopeGetEnrollmentReceiptSecurityByEntrollment($query, $enrollmentId, $programId)
    {
        return DB::table('payment_master AS PM')
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
            ->where('PM.enrollment_id', $enrollmentId)
            ->where('PM.is_gst_bill', 'N')
            ->whereNotNull('PCC.component_id')
            ->whereIn('PCC.component_id', function ($query) use ($programId) {
                $query->select('component_id')
                    ->from('programme_commercial_component')
                    ->where('programme_id', $programId)
                    ->where('is_security', 'Y');
            })
            ->groupBy('PCC.component_id')->get();
    }

    public function scopeGetEnrollmentReceiptByEnrollment($query, $enrollmentId, $programId)
    {
        return DB::table('payment_master AS PM')
            ->select(
                'PM.*',
                'PD.*',
                'MRD.*',
                'PMD.*',
                'PCC.*',
                'MM.*',
                'MNM.*',
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
            ->leftJoin('month_master AS MNM', 'MNM.id', '=', 'MRD.month_id')
            ->leftJoin('users', 'users.id', '=', 'MRM.inactive_by')
            ->where('PM.enrollment_id', $enrollmentId)
            ->where('PM.is_gst_bill', 'N')
            ->whereNotIn('PCC.component_id', function ($query) use ($programId) {
                $query->select('component_id')
                    ->from('programme_commercial_component')
                    ->where('programme_id', $programId)
                    ->where('is_security', 'Y');
            })
            ->groupBy('MRD.receipt_dtl_id')
            ->orderByRaw('MRD.year, MRD.month_id')
            ->get();
    }
}
