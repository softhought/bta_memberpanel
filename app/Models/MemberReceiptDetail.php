<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberReceiptDetail extends BaseModel
{
    use HasFactory;
    protected $table = 'member_receipt_details';

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
