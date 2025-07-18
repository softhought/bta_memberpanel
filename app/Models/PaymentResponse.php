<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentResponse extends BaseModel
{
    use HasFactory;
    protected $table = 'payment_response';
    protected $fillable = [
        'transaction_id',
        'order_id',
        'payment_status',
        'processing_date',
        'tracking_id',
        'bank_ref_no',
        'payment_geteway',
        'response_data',
        'payment_message'
    ];
}
