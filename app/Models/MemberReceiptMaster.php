<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberReceiptMaster extends BaseModel
{
    use HasFactory;
    protected $table = 'member_receipt_master';
    // protected $fillable = [
    //     'receipt_no',
    //     'receipt_date',
    //     'reference_no',
    //     'no_of_months',
    //     'total_amount',
    //     'total_discount',
    //     'total_taxable_amount',
    //     'total_cgst_amount',
    //     'total_sgst_amount',
    //     'total_gst_amount',
    //     'adjust_amount',
    //     'net_payble_amount',
    //     'year_id',
    //     'company_id',
    //     'user_id',
    //     'entry_from',
    //     'bill_type',
    //     'is_general_receipt',
    //     'is_active',
    //     'is_wave_receipt',
    //     'active_programme_group'
    // ];

    public function receiptDetails()
    {
        return $this->hasMany(MemberReceiptDetail::class, 'receipt_master_id');
    }
}
