<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class PaymentMaster extends BaseModel
{
    use HasFactory;
    protected $table = 'payment_master';
    protected $fillable = [
        'receipt_master_id',
        'member_id',
        'enrollment_id',
        'voucher_id',
        'payment_no',
        'payment_date',
        'total_payble_amount',
        'payment_amount',
        'short_excess_cr_ac_id',
        'short_excess_amount',
        'company_id',
        'year_id',
        'round_off_account_id',
        'round_off_amount',
        'is_gst_bill',
        'total_bank_charges',
    ];

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
            ->where('MRM.is_active', 'Y')
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
            ->where('MRM.is_active', 'Y')
            ->groupBy('PCC.component_id')->get();
    }

    public function scopeGetEnrollmentReceiptByEnrollment($query, $enrollmentId, $programId)
    {
        $btaAdmin = session()->get('btaMember');
        $yearId = $btaAdmin['yearId'];

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
            ->where('PM.year_id', $yearId)
            ->whereNotIn('PCC.component_id', function ($query) use ($programId) {
                $query->select('component_id')
                    ->from('programme_commercial_component')
                    ->where('programme_id', $programId)
                    ->where('is_security', 'Y');
            })
            ->where('MRM.is_active', 'Y')
            ->groupBy('MRD.receipt_dtl_id')
            ->orderByRaw('MRD.year, MRD.month_id')
            ->get();
    }
}
