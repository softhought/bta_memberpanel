<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends BaseModel
{
    use HasFactory;
    protected $table = 'member_master';

    public function programEnrollment()
    {
        return $this->hasMany(ProgrammeEnrollmentMaster::class, 'member_id', 'member_id')->whereNotIn('programme_id', [2, 5]);
    }

    public function scopeGetEnrolledDetail($query, $memberId, $program, $status = 'Y')
    {
        return $query->join('programme_enrollment_master as pem', 'pem.member_id', '=', 'member_master.member_id')
            ->join('programme_master as pm', 'pm.programme_id', '=', 'pem.programme_id')
            ->where('pm.short_code', $program)
            ->when($status, function ($query) use ($status) {
                $query->where('pem.is_active', 'Y');
            })
            ->where('member_master.member_id', $memberId)
            ->select('pem.*');
    }


}
