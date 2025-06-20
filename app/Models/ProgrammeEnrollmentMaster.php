<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammeEnrollmentMaster extends BaseModel
{
    use HasFactory;
    protected $table = 'programme_enrollment_master';

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function program()
    {
        return $this->belongsTo(ProgramMaster::class, 'programme_id');
    }

    public function group()
    {
        return $this->belongsTo(GroupMaster::class, 'group_id');
    }
}
