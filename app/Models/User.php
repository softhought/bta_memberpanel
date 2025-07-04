<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends BaseModel
{
    use HasFactory;
    protected $table = 'users';

    public function role()
    {
        return $this->belongsTo(Role::class, 'web_role_id');
    }
}
