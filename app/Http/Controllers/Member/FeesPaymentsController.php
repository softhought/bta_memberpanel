<?php

namespace App\Http\Controllers\Member;

use App\Constants\Constant;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Component;
use App\Models\ComponentMonthlyDetail;
use App\Models\Member;
use App\Models\PaymentMaster;
use App\Models\PaymentMode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeesPaymentsController extends Controller
{
    public function fetchHPView(Request $request)
    {
        $btaAdmin = session()->get('btaMember');
        $memberId = $btaAdmin['memberId'];

        $enrolmentModel = Member::GetEnrolledDetail($memberId, 'HP');

        $data['isExists'] = $enrolmentModel->exists();

        $data['paymentMaster'] = PaymentMaster::where('enrollment_id', $enrolmentModel->first()?->enrollment_id)
            ->where('member_id', $memberId)
            ->orderByDesc('payment_date')
            ->first();

        $data['paymentMode'] = PaymentMode::all();
        $data['bank'] = Bank::all();

        $view = view('member.fees.hp.hpPartialView', $data)->render();
        return response()->json(['status' => Constant::SUCCESS, 'view' => $view]);
    }

    public function fetchJHPView(Request $request)
    {
        $btaAdmin = session()->get('btaMember');
        $memberId = $btaAdmin['memberId'];

        $enrolmentModel = Member::GetEnrolledDetail($memberId, 'JHP');

        $data['isExists'] = $enrolmentModel->exists();

        $data['paymentMaster'] = PaymentMaster::where('enrollment_id', $enrolmentModel->first()?->enrollment_id)
            ->where('member_id', $memberId)
            ->orderByDesc('payment_date')
            ->first();

        $data['paymentMode'] = PaymentMode::all();
        $data['bank'] = Bank::all();

        $view = view('member.fees.jhp.jhpPartialView', $data)->render();
        return response()->json(['status' => Constant::SUCCESS, 'view' => $view]);
    }

    public function fetchJCPView(Request $request)
    {
        $btaAdmin = session()->get('btaMember');
        $memberId = $btaAdmin['memberId'];

        $enrolmentModel = Member::GetEnrolledDetail($memberId, 'JCP');

        $data['isExists'] = $enrolmentModel->exists();

        $data['paymentMaster'] = PaymentMaster::where('enrollment_id', $enrolmentModel->first()?->enrollment_id)
            ->where('member_id', $memberId)
            ->orderByDesc('payment_date')
            ->first();

        $data['paymentMode'] = PaymentMode::all();
        $data['bank'] = Bank::all();

        $view = view('member.fees.jcp.jcpPartialView', $data)->render();
        return response()->json(['status' => Constant::SUCCESS, 'view' => $view]);
    }

    public function fetchPFView(Request $request)
    {
        $btaAdmin = session()->get('btaMember');
        $memberId = $btaAdmin['memberId'];

        $enrolmentModel = Member::GetEnrolledDetail($memberId, 'PF');

        $data['isExists'] = $enrolmentModel->exists();

        $data['paymentMaster'] = PaymentMaster::where('enrollment_id', $enrolmentModel->first()?->enrollment_id)
            ->where('member_id', $memberId)
            ->orderByDesc('payment_date')
            ->first();

        $data['paymentMode'] = PaymentMode::all();
        $data['bank'] = Bank::all();

        $view = view('member.fees.pf.pfPartialView', $data)->render();
        return response()->json(['status' => Constant::SUCCESS, 'view' => $view]);
    }

    public function fetchMonths(Request $request)
    {
        $btaAdmin = session()->get('btaMember');
        $memberId = $btaAdmin['memberId'];

        $monthCount = $request->post('monthCount');
        $lastPaidMonthId = $request->post('lastPaidMonthId');
        $lastPaidYear = $request->post('lastPaidYear');
        $program = $request->post('program');

        $enrolmentModel = Member::GetEnrolledDetail($memberId, $program)->first();

        $componentModel = Component::where('programme_id', $enrolmentModel->programme_id)
            ->when($enrolmentModel->group_id != 0, function ($query) use ($enrolmentModel) {
                $query->where('group_id', $enrolmentModel->group_id);
            })
            ->where('component_type', 'MONTHLY')
            ->first();

        $componentId = $componentModel->component_id;

        $data['upcomingMonthlyDetails'] = ComponentMonthlyDetail::where('component_id', $componentId)
            ->where(function ($query) use ($lastPaidYear, $lastPaidMonthId) {
                $query->where(DB::raw('CAST(year AS UNSIGNED)'), '>', $lastPaidYear)
                    ->orWhere(function ($q) use ($lastPaidYear, $lastPaidMonthId) {
                        $q->where('year', $lastPaidYear)
                            ->where('month_id', '>', $lastPaidMonthId);
                    });
            })
            ->orderBy(DB::raw('CAST(year AS UNSIGNED)'))
            ->orderBy('month_id')
            ->take($monthCount)
            ->get();

        $view = view('member.fees.months', $data)->render();
        return response()->json(['status' => Constant::SUCCESS, 'view' => $view]);
    }
}
