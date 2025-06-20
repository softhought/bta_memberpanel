<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMode extends BaseModel
{
    use HasFactory;
    protected $table = 'payment_mode_details';
}
