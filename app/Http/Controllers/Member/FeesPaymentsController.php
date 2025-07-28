<?php

namespace App\Http\Controllers\Member;

use App\Constants\Constant;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Component;
use App\Models\ComponentMonthlyDetail;
use App\Models\Member;
use App\Models\MemberReceiptDetail;
use App\Models\MemberReceiptMaster;
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

        $enrollment = $enrolmentModel->first();

        $data['paymentMaster'] = null;
        if ($enrollment) {
            $paymentMaster = DB::selectOne("
                    SELECT PM.*
                    FROM member_receipt_details AS MRD
                    INNER JOIN month_master AS MNM ON MRD.month_id = MNM.id
                    INNER JOIN member_receipt_master ON member_receipt_master.receipt_id = MRD.receipt_master_id
                    INNER JOIN payment_master AS PM ON PM.receipt_master_id = member_receipt_master.receipt_id
                    WHERE MRD.receipt_dtl_id IN (
                        SELECT MAX(MRD.receipt_dtl_id)
                        FROM payment_master AS PM
                        INNER JOIN programme_enrollment_master AS PEM ON PM.enrollment_id = PEM.enrollment_id
                        INNER JOIN member_receipt_master AS MRM ON PM.receipt_master_id = MRM.receipt_id
                        INNER JOIN member_receipt_details AS MRD ON MRM.receipt_id = MRD.receipt_master_id
                        INNER JOIN programme_commercial_component AS PCC ON MRD.component_id = PCC.component_id
                        WHERE PM.member_id = :member_id
                        AND PM.enrollment_id = :enrollment_id
                        AND PEM.programme_id = :programme_id
                        AND PCC.component_type = 'MONTHLY'
                    )
                    LIMIT 1
                ", [
                'member_id' => $memberId,
                'enrollment_id' => $enrollment->enrollment_id,
                'programme_id' => $enrollment->programme_id,
            ]);

            $paymentMaster->receipt = MemberReceiptDetail::where('receipt_master_id', $paymentMaster->receipt_master_id)->orderByDesc('receipt_dtl_id')->first();
            $data['paymentMaster'] = $paymentMaster;
        }

        $data['enrollment'] = $enrollment;
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

        $enrollment = $enrolmentModel->first();

        $data['paymentMaster'] = null;
        if ($enrollment) {
            $paymentMaster = DB::selectOne("
                    SELECT PM.*
                    FROM member_receipt_details AS MRD
                    INNER JOIN month_master AS MNM ON MRD.month_id = MNM.id
                    INNER JOIN member_receipt_master ON member_receipt_master.receipt_id = MRD.receipt_master_id
                    INNER JOIN payment_master AS PM ON PM.receipt_master_id = member_receipt_master.receipt_id
                    WHERE MRD.receipt_dtl_id IN (
                        SELECT MAX(MRD.receipt_dtl_id)
                        FROM payment_master AS PM
                        INNER JOIN programme_enrollment_master AS PEM ON PM.enrollment_id = PEM.enrollment_id
                        INNER JOIN member_receipt_master AS MRM ON PM.receipt_master_id = MRM.receipt_id
                        INNER JOIN member_receipt_details AS MRD ON MRM.receipt_id = MRD.receipt_master_id
                        INNER JOIN programme_commercial_component AS PCC ON MRD.component_id = PCC.component_id
                        WHERE PM.member_id = :member_id
                        AND PM.enrollment_id = :enrollment_id
                        AND PEM.programme_id = :programme_id
                        AND PCC.component_type = 'MONTHLY'
                    )
                    LIMIT 1
                ", [
                'member_id' => $memberId,
                'enrollment_id' => $enrollment->enrollment_id,
                'programme_id' => $enrollment->programme_id,
            ]);

            $paymentMaster->receipt = MemberReceiptDetail::where('receipt_master_id', $paymentMaster->receipt_master_id)->orderByDesc('receipt_dtl_id')->first();
            $data['paymentMaster'] = $paymentMaster;
        }

        $data['enrollment'] = $enrollment;
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

        $enrollment = $enrolmentModel->first();

        $data['paymentMaster'] = null;
        if ($enrollment) {
            $paymentMaster = DB::selectOne("
                    SELECT PM.*
                    FROM member_receipt_details AS MRD
                    INNER JOIN month_master AS MNM ON MRD.month_id = MNM.id
                    INNER JOIN member_receipt_master ON member_receipt_master.receipt_id = MRD.receipt_master_id
                    INNER JOIN payment_master AS PM ON PM.receipt_master_id = member_receipt_master.receipt_id
                    WHERE MRD.receipt_dtl_id IN (
                        SELECT MAX(MRD.receipt_dtl_id)
                        FROM payment_master AS PM
                        INNER JOIN programme_enrollment_master AS PEM ON PM.enrollment_id = PEM.enrollment_id
                        INNER JOIN member_receipt_master AS MRM ON PM.receipt_master_id = MRM.receipt_id
                        INNER JOIN member_receipt_details AS MRD ON MRM.receipt_id = MRD.receipt_master_id
                        INNER JOIN programme_commercial_component AS PCC ON MRD.component_id = PCC.component_id
                        WHERE PM.member_id = :member_id
                        AND PM.enrollment_id = :enrollment_id
                        AND PEM.programme_id = :programme_id
                        AND PCC.component_type = 'MONTHLY'
                    )
                    LIMIT 1
                ", [
                'member_id' => $memberId,
                'enrollment_id' => $enrollment->enrollment_id,
                'programme_id' => $enrollment->programme_id,
            ]);

            $paymentMaster->receipt = MemberReceiptDetail::where('receipt_master_id', $paymentMaster->receipt_master_id)->orderByDesc('receipt_dtl_id')->first();
            $data['paymentMaster'] = $paymentMaster;
        }

        $data['enrollment'] = $enrollment;
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

        $enrollment = $enrolmentModel->first();

        $data['paymentMaster'] = null;
        if ($enrollment) {
            $paymentMaster = DB::selectOne("
                    SELECT PM.*
                    FROM member_receipt_details AS MRD
                    INNER JOIN month_master AS MNM ON MRD.month_id = MNM.id
                    INNER JOIN member_receipt_master ON member_receipt_master.receipt_id = MRD.receipt_master_id
                    INNER JOIN payment_master AS PM ON PM.receipt_master_id = member_receipt_master.receipt_id
                    WHERE MRD.receipt_dtl_id IN (
                        SELECT MAX(MRD.receipt_dtl_id)
                        FROM payment_master AS PM
                        INNER JOIN programme_enrollment_master AS PEM ON PM.enrollment_id = PEM.enrollment_id
                        INNER JOIN member_receipt_master AS MRM ON PM.receipt_master_id = MRM.receipt_id
                        INNER JOIN member_receipt_details AS MRD ON MRM.receipt_id = MRD.receipt_master_id
                        INNER JOIN programme_commercial_component AS PCC ON MRD.component_id = PCC.component_id
                        WHERE PM.member_id = :member_id
                        AND PM.enrollment_id = :enrollment_id
                        AND PEM.programme_id = :programme_id
                        AND PCC.component_type = 'MONTHLY'
                    )
                    LIMIT 1
                ", [
                'member_id' => $memberId,
                'enrollment_id' => $enrollment->enrollment_id,
                'programme_id' => $enrollment->programme_id,
            ]);

            $paymentMaster->receipt = MemberReceiptDetail::where('receipt_master_id', $paymentMaster->receipt_master_id)->orderByDesc('receipt_dtl_id')->first();
            $data['paymentMaster'] = $paymentMaster;
        }

        $data['enrollment'] = $enrollment;
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

        $enrollment = Member::GetEnrolledDetail($memberId, $program)->first();

        if (!$enrollment) {
            return response()->json(['status' => Constant::FAILURE, 'message' => 'No enrollment found']);
        }

        $componentModel = Component::where('programme_id', $enrollment->programme_id)
            ->when($enrollment->group_id != 0, function ($query) use ($enrollment) {
                $query->where('group_id', $enrollment->group_id);
            })
            ->where('component_type', 'MONTHLY')
            ->first();

        $componentId = $componentModel ? $componentModel->component_id : 0;

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
