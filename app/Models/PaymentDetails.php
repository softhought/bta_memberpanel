<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetails extends BaseModel
{
    use HasFactory;
    protected $table = 'payment_details';

    protected $fillable = [
        'payment_master_id',
        'payment_mode_id',
        'dr_account_id',
        'amount',
        'cheque_date',
        'bank_charges',
        'payment_ref',
        'discription'
    ];
}
