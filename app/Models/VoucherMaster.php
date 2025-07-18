<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherMaster extends BaseModel
{
    use HasFactory;
    protected $table = 'voucher_master';
    protected $fillable = [
        'voucher_no',
        'voucher_date',
        'tran_type',
        'narration',
        'total_cr_amt',
        'total_dr_amt',
        'user_id',
        'year_id',
        'company_id',
        'reference_no'
    ];
}
