<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends BaseModel
{
    use HasFactory;
    protected $table = 'payment_request';
}
