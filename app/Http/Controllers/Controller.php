<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public static function renderView($data = [])
    {
        $data['forceChangePassword'] = false;

        $btaAdmin = session()->get('btaMember');
        $memberId = !empty($btaAdmin['memberId']) ? $btaAdmin['memberId'] : 0;

        $memberData = Member::find($memberId);

        if ($memberData && Hash::check('123456', $memberData->password)) {
            $data['forceChangePassword'] = true;
        }

        if (empty($memberData->primary_mobile) || empty($memberData->primary_email)) {
            return redirect('member/profile');
        }

        processPendingPayments();

        return view('layout', $data);
    }
}
