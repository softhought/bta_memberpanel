<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMaster extends BaseModel
{
    use HasFactory;
    protected $table = 'payment_master';

    public function receipt()
    {
        return $this->belongsTo(MemberReceiptMaster::class, 'receipt_master_id');
    }
}
