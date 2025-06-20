<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Component extends BaseModel
{
    use HasFactory;
    protected $table = 'programme_commercial_component';

    public function monthlyDetail()
    {
        return $this->hasMany(ComponentMonthlyDetail::class, 'component_id');
    }
}
