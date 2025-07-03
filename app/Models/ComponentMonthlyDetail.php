<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComponentMonthlyDetail extends BaseModel
{
    use HasFactory;
    protected $table = 'component_monthly_details';

    public function month()
    {
        return $this->belongsTo(Month::class, 'month_id');
    }
}
