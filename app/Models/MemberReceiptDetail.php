<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberReceiptDetail extends BaseModel
{
    use HasFactory;
    protected $table = 'member_receipt_details';
    protected $fillable = [
        'receipt_master_id',
        'year',
        'month_id',
        'cr_ac_id',
        'component_id',
        'item_amount',
        'item_qty',
        'amount',
        'discount',
        'taxable_amount',
        'cgst_id',
        'sgst_id',
        'cgst_amount',
        'sgst_amount',
        'total_gst_amount',
        'is_payment_due',
        'due_amount',
        'net_amount',
        'is_waiver',
    ];

    public function receipt()
    {
        return $this->belongsTo(MemberReceiptMaster::class, 'receipt_master_id');
    }

    public function component()
    {
        return $this->belongsTo(Component::class, 'component_id');
    }

    public function month()
    {
        return $this->belongsTo(Month::class, 'month_id');
    }
}
