<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Constant;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\PaymentMaster;
use Illuminate\Http\Request;

class AdminTransactionsController extends Controller
{
    public function fetchUserTransactionView(Request $request)
    {
        $memberId = $request->post('member_code');

        $memberData = Member::with(['programEnrollment.program', 'programEnrollment.group'])->find($memberId);
        $data['member'] = $memberData;

        $view = view('admin.transactions.transactions', $data)->render();
        return response()->json(['status' => Constant::SUCCESS, 'view' => $view]);
    }

    public function fetchTransactions(Request $request)
    {
        $memberId = $request->post('member_code');

        $program = $request->post('program');

        $enrolmentModel = Member::GetEnrolledDetail($memberId, $program, NULL);
        $data['isExists'] = $enrolmentModel->exists();

        $enrollment = $enrolmentModel->first();

        $data['paymentMaster'] = null;
        if ($enrollment) {
            $data['paymentMaster'] = PaymentMaster::where('enrollment_id', $enrollment->enrollment_id)
                ->where('member_id', $memberId)
                ->orderByDesc('payment_date')
                ->first();
        }

        $data['enrollmentReceiptGST'] = null;
        $data['enrollmentReceiptSecurityGST'] = null;
        $data['enrollmentReceiptMonthly'] = null;

        if ($enrollment) {
            $data['enrollmentReceiptGST'] = PaymentMaster::GetEnrollmentReceiptGSTByEnrollment($enrollment->enrollment_id);
            $data['enrollmentReceiptSecurityGST'] = PaymentMaster::GetEnrollmentReceiptSecurityByEntrollment($enrollment->enrollment_id, $enrollment->programme_id);
            $data['enrollmentReceiptMonthly'] = PaymentMaster::GetEnrollmentReceiptByEnrollment($enrollment->enrollment_id, $enrollment->programme_id);
        }

        $view = view('admin.transactions.transactionsView', $data)->render();
        return response()->json(['status' => Constant::SUCCESS, 'view' => $view]);
    }
}
