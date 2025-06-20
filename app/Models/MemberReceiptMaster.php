<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberReceiptMaster extends BaseModel
{
    use HasFactory;
    protected $table = 'member_receipt_master';

    public function receiptDetails()
    {
        return $this->hasMany(MemberReceiptDetail::class, 'receipt_master_id');
    }
}
