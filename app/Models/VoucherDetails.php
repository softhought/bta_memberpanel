<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherDetails extends BaseModel
{
    use HasFactory;
    protected $table = 'voucher_detail';

    protected $fillable = [
        'voucher_master_id',
        'tran_tag',
        'account_master_id',
        'amount',
        'srl_no',
    ];
}
