<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LayoutController;
use App\Models\Member;
use App\Models\OneTimeTaskMaster;
use App\Models\TaskCapture;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index() {
        $btaAdmin = session()->get('btaMember');
        $memberId = $btaAdmin['memberId'];

        $memberData = Member::with(['programEnrollment.program', 'programEnrollment.group'])->find($memberId);
        $data['member'] = $memberData;

        $data['bodyView'] = view('member.dashboard', $data ?? []);
        return $this->renderView($data);
    }

    public function feesPayments() {
        $btaAdmin = session()->get('btaMember');
        $memberId = $btaAdmin['memberId'];

        $memberData = Member::with(['programEnrollment.program', 'programEnrollment.group'])->find($memberId);
        $data['member'] = $memberData;

        $data['bodyView'] = view('member.fees.feesPayments', $data ?? []);
        return $this->renderView($data);
    }

    public function transactions() {
        $btaAdmin = session()->get('btaMember');
        $memberId = $btaAdmin['memberId'];

        $memberData = Member::with(['programEnrollment.program', 'programEnrollment.group'])->find($memberId);
        $data['member'] = $memberData;

        $data['bodyView'] = view('member.transactions.transactions', $data ?? []);
        return $this->renderView($data);
    }
}
