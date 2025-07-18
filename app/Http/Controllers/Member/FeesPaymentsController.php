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
            $paymentMaster = PaymentMaster::query()
                ->from('payment_master as PM')
                ->leftJoin('payment_details as PD', 'PD.payment_master_id', '=', 'PM.payment_id')
                ->leftJoin('member_receipt_master as MRM', 'MRM.receipt_id', '=', 'PM.receipt_master_id')
                ->leftJoin('member_receipt_details as MRD', 'MRD.receipt_master_id', '=', 'MRM.receipt_id')
                ->leftJoin('payment_mode_details as PMD', 'PMD.id', '=', 'PD.payment_mode_id')
                ->leftJoin('programme_commercial_component as PCC', 'PCC.component_id', '=', 'MRD.component_id')
                ->leftJoin('member_master as MM', 'MM.member_id', '=', 'PM.member_id')
                ->leftJoin('month_master as MNM', 'MNM.id', '=', 'MRD.month_id')
                ->where('PM.enrollment_id', $enrollment->enrollment_id)
                ->where('PM.member_id', $memberId)
                ->where('PM.is_gst_bill', 'N')
                ->whereNotIn('PCC.component_id', function ($query) use ($enrollment) {
                    $query->select('component_id')
                        ->from('programme_commercial_component')
                        ->where('programme_id', $enrollment->programme_id)
                        ->where('is_security', 'Y');
                })
                ->select('PM.*')
                ->groupBy('MRD.receipt_dtl_id')
                ->orderBy('MRD.year')
                ->orderBy('MRD.month_id')
                ->last();

            $paymentMaster->receipt = MemberReceiptDetail::where('receipt_master_id', $paymentMaster->receipt_master_id)->orderByDesc('receipt_master_id')->first();
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
            $paymentMaster = PaymentMaster::query()
                ->from('payment_master as PM')
                ->leftJoin('payment_details as PD', 'PD.payment_master_id', '=', 'PM.payment_id')
                ->leftJoin('member_receipt_master as MRM', 'MRM.receipt_id', '=', 'PM.receipt_master_id')
                ->leftJoin('member_receipt_details as MRD', 'MRD.receipt_master_id', '=', 'MRM.receipt_id')
                ->leftJoin('payment_mode_details as PMD', 'PMD.id', '=', 'PD.payment_mode_id')
                ->leftJoin('programme_commercial_component as PCC', 'PCC.component_id', '=', 'MRD.component_id')
                ->leftJoin('member_master as MM', 'MM.member_id', '=', 'PM.member_id')
                ->leftJoin('month_master as MNM', 'MNM.id', '=', 'MRD.month_id')
                ->where('PM.enrollment_id', $enrollment->enrollment_id)
                ->where('PM.member_id', $memberId)
                ->where('PM.is_gst_bill', 'N')
                ->whereNotIn('PCC.component_id', function ($query) use ($enrollment) {
                    $query->select('component_id')
                        ->from('programme_commercial_component')
                        ->where('programme_id', $enrollment->programme_id)
                        ->where('is_security', 'Y');
                })
                ->select('PM.*')
                ->groupBy('MRD.receipt_dtl_id')
                ->orderBy('MRD.year')
                ->orderBy('MRD.month_id')
                ->last();

            $paymentMaster->receipt = MemberReceiptDetail::where('receipt_master_id', $paymentMaster->receipt_master_id)->orderByDesc('receipt_master_id')->first();
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
            $paymentMaster = PaymentMaster::query()
                ->from('payment_master as PM')
                ->leftJoin('payment_details as PD', 'PD.payment_master_id', '=', 'PM.payment_id')
                ->leftJoin('member_receipt_master as MRM', 'MRM.receipt_id', '=', 'PM.receipt_master_id')
                ->leftJoin('member_receipt_details as MRD', 'MRD.receipt_master_id', '=', 'MRM.receipt_id')
                ->leftJoin('payment_mode_details as PMD', 'PMD.id', '=', 'PD.payment_mode_id')
                ->leftJoin('programme_commercial_component as PCC', 'PCC.component_id', '=', 'MRD.component_id')
                ->leftJoin('member_master as MM', 'MM.member_id', '=', 'PM.member_id')
                ->leftJoin('month_master as MNM', 'MNM.id', '=', 'MRD.month_id')
                ->where('PM.enrollment_id', $enrollment->enrollment_id)
                ->where('PM.member_id', $memberId)
                ->where('PM.is_gst_bill', 'N')
                ->whereNotIn('PCC.component_id', function ($query) use ($enrollment) {
                    $query->select('component_id')
                        ->from('programme_commercial_component')
                        ->where('programme_id', $enrollment->programme_id)
                        ->where('is_security', 'Y');
                })
                ->select('PM.*')
                ->groupBy('MRD.receipt_dtl_id')
                ->orderBy('MRD.year')
                ->orderBy('MRD.month_id')
                ->last();
                $paymentMaster->receipt = MemberReceiptDetail::where('receipt_master_id', $paymentMaster->receipt_master_id)->orderByDesc('receipt_master_id')->first();
                $data['paymentMaster'] = $paymentMaster;
            }
            pre($data['paymentMaster']);exit;
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
            $paymentMaster = PaymentMaster::query()
                ->from('payment_master as PM')
                ->leftJoin('payment_details as PD', 'PD.payment_master_id', '=', 'PM.payment_id')
                ->leftJoin('member_receipt_master as MRM', 'MRM.receipt_id', '=', 'PM.receipt_master_id')
                ->leftJoin('member_receipt_details as MRD', 'MRD.receipt_master_id', '=', 'MRM.receipt_id')
                ->leftJoin('payment_mode_details as PMD', 'PMD.id', '=', 'PD.payment_mode_id')
                ->leftJoin('programme_commercial_component as PCC', 'PCC.component_id', '=', 'MRD.component_id')
                ->leftJoin('member_master as MM', 'MM.member_id', '=', 'PM.member_id')
                ->leftJoin('month_master as MNM', 'MNM.id', '=', 'MRD.month_id')
                ->where('PM.enrollment_id', $enrollment->enrollment_id)
                ->where('PM.member_id', $memberId)
                ->where('PM.is_gst_bill', 'N')
                ->whereNotIn('PCC.component_id', function ($query) use ($enrollment) {
                    $query->select('component_id')
                        ->from('programme_commercial_component')
                        ->where('programme_id', $enrollment->programme_id)
                        ->where('is_security', 'Y');
                })
                ->select('PM.*')
                ->groupBy('MRD.receipt_dtl_id')
                ->orderBy('MRD.year')
                ->orderBy('MRD.month_id')
                ->last();

            $paymentMaster->receipt = MemberReceiptDetail::where('receipt_master_id', $paymentMaster->receipt_master_id)->orderByDesc('receipt_master_id')->first();
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
