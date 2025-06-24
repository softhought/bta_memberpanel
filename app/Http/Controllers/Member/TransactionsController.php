<?php

namespace App\Http\Controllers\Member;

use App\Constants\Constant;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\PaymentMaster;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{

    public function fetchTransactions(Request $request)
    {
        $btaAdmin = session()->get('btaMember');
        $memberId = $btaAdmin['memberId'];

        $program = $request->post('program');

        $enrolmentModel = Member::GetEnrolledDetail($memberId, $program, NULL);

        $data['isExists'] = $enrolmentModel->exists();

        $data['paymentMaster'] = PaymentMaster::where('enrollment_id', $enrolmentModel->first()?->enrollment_id)
            ->where('member_id', $memberId)
            ->orderByDesc('payment_date')
            ->first();

        $data['enrollmentReceiptGST'] = PaymentMaster::GetEnrollmentReceiptGSTByEnrollment($enrolmentModel->first()?->enrollment_id);
        $data['enrollmentReceiptSecurityGST'] = PaymentMaster::GetEnrollmentReceiptSecurityByEntrollment($enrolmentModel->first()?->enrollment_id, $enrolmentModel->first()?->programme_id);
        $data['enrollmentReceiptMonthly'] = PaymentMaster::GetEnrollmentReceiptByEnrollment($enrolmentModel->first()?->enrollment_id, $enrolmentModel->first()?->programme_id);

        $view = view('member.transactions.transactionsView', $data)->render();
        return response()->json(['status' => Constant::SUCCESS, 'view' => $view]);
    }
}
