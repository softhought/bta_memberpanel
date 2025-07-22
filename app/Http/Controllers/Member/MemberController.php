<?php

namespace App\Http\Controllers\Member;

use App\Constants\Constant;
use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function index()
    {
        $btaAdmin = session()->get('btaMember');
        $memberId = $btaAdmin['memberId'];

        $memberData = Member::with(['programEnrollment.program', 'programEnrollment.group'])->find($memberId);
        $data['member'] = $memberData;

        $data['bodyView'] = view('member.dashboard', $data);
        return $this->renderView($data);
    }

    public function feesPayments()
    {
        $btaAdmin = session()->get('btaMember');
        $memberId = $btaAdmin['memberId'];

        $memberData = Member::with(['programEnrollment.program', 'programEnrollment.group'])->find($memberId);
        $data['member'] = $memberData;

        $data['bodyView'] = view('member.fees.feesPayments', $data);
        return $this->renderView($data);
    }

    public function transactions()
    {
        $btaAdmin = session()->get('btaMember');
        $memberId = $btaAdmin['memberId'];

        $memberData = Member::with(['programEnrollment.program', 'programEnrollment.group'])->find($memberId);
        $data['member'] = $memberData;

        $data['bodyView'] = view('member.transactions.transactions', $data);
        return $this->renderView($data);
    }

    public function changePassword()
    {
        $btaAdmin = session()->get('btaMember');
        $memberId = $btaAdmin['memberId'];

        $data['member'] = Member::find($memberId);

        $data['bodyView'] = view('member.password', $data);
        return $this->renderView($data);
    }

    public function changePasswordAction(Request $request)
    {
        $btaAdmin = session()->get('btaMember');
        $memberId = $btaAdmin['memberId'];

        $currentPassword = $request->post('current_password');
        $newPassword = $request->post('new_password');

        $result = Member::find($memberId);

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ], [
            'current_password.required' => 'The current password is required.',
            'new_password.required' => 'The new password is required.',
            'new_password.min' => 'The new password must be at least 6 characters.',
            'confirm_password.required' => 'The confirm password is required.',
            'confirm_password.same' => 'The confirm password must match the new password.',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return response()->json(['status' => Constant::VALID_FAILURE, 'errors' => $error]);
        } else {
            if (Hash::check($currentPassword, $result->password)) {
                $result->password = Hash::make($newPassword);
                $result->save();

                return response()->json(['status' => Constant::SUCCESS, 'message' => 'Password changed successfully.']);
            } else {
                return response()->json([
                    'status' => Constant::VALID_FAILURE,
                    'errors' => ['current_password' => 'The current password is invalid.']
                ]);
            }
        }
    }

    public function forceChangePassword(Request $request)
    {
        $btaAdmin = session()->get('btaMember');
        $memberId = $btaAdmin['memberId'];

        $newPassword = $request->post('new_password');

        $result = Member::find($memberId);

        $validator = Validator::make($request->all(), [
            'new_password' => [
                'required',
                'min:6',
                function ($attribute, $value, $fail) {
                    if ($value === '123456') {
                        $fail('The password "123456" is too common and not acceptable.');
                    }
                }
            ],
            'confirm_password' => 'required|same:new_password',
        ], [
            'new_password.required' => 'The new password is required.',
            'new_password.min' => 'The new password must be at least 6 characters.',
            'confirm_password.required' => 'The confirm password is required.',
            'confirm_password.same' => 'The confirm password must match the new password.',
        ]);


        if ($validator->fails()) {
            $error = $validator->errors();
            return response()->json(['status' => Constant::VALID_FAILURE, 'errors' => $error]);
        } else {

            $result->password = Hash::make($newPassword);
            $result->save();

            return response()->json(['status' => Constant::SUCCESS, 'message' => 'Password changed successfully.']);

        }
    }

    public function aboutUs()
    {
        return view('aboutUs');
    }

    public function contactUs()
    {
        return view('contactUs');
    }

    public function privacyPolicy()
    {
        return view('privacyPolicy');
    }

    public function termsAndConditions()
    {
        return view('termsAndConditions');
    }

    public function refundPolicy()
    {
        return view('refundPolicy');
    }

    public function enquirySubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required|string',
        ]);

        Enquiry::updateOrCreate(
            ['id' => 0], // Always inserts new
            [
                'name' => $request->post('name'),
                'email' => $request->post('email'),
                'phone' => $request->post('phone'),
                'message' => $request->post('message'),
            ]
        );

        return back()->with('success', 'Thank you! Your enquiry has been submitted.');
    }




    public function profile()
    {
        $btaAdmin = session()->get('btaMember');
        $memberId = $btaAdmin['memberId'];

        $data['member'] = Member::find($memberId);

        $data['bodyView'] = view('member.profile', $data);
        return $this->renderView($data);
    }

    public function profileAction(Request $request)
    {
        $btaAdmin = session()->get('btaMember');
        $memberId = $btaAdmin['memberId'];

        $number = $request->post('number');
        $email = $request->post('email');
        $address = $request->post('address');

        $result = Member::find($memberId);

        $validator = Validator::make($request->all(), [
            'number' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return response()->json(['status' => Constant::VALID_FAILURE, 'errors' => $error]);
        } else {

            $result->primary_mobile = $number;
            $result->primary_email = $email;
            $result->address_one = $address;
            $result->save();

            return response()->json(['status' => Constant::SUCCESS, 'message' => 'Profile successfully updated.']);
        }
    }

    /** Reset Password */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'member_code' => 'required|string'
        ]);

        $member = Member::where('member_code', $request->post('member_code'))->first();

        if (!$member) {
            return response()->json(['status' => 'error', 'message' => 'Registration number not found.']);
        }

        $email = $member->primary_email;

        if (empty($email)) {
            return response()->json(['status' => 'error', 'message' => 'No email associated with this account.']);
        }

        $otp = rand(100000, 999999);
        Session::put('otp_' . $request->post('member_code'), $otp);

        $subject = 'Your OTP for Password Reset';
        $data = ['otp' => $otp, 'member_code' => $member->member_code, 'name' => "{$member->member_fname} {$member->member_lname}"];
        $view = view('emails.otp_template', $data);

        $result = sendEmail($email, $subject, $view);

        if ($result !== true) {
            return response()->json(['status' => 'error', 'message' => "Failed to send email.", 'error' => $result]);
        }

        $maskedEmail = $this->maskEmail($email);

        return response()->json(['status' => 'success', 'email_masked' => $maskedEmail]);
    }


    public function verifyOtp(Request $request)
    {
        $request->validate([
            'member_code' => 'required',
            'otp' => 'required'
        ]);

        $sessionOtp = Session::get('otp_' . $request->post('member_code'));

        if ($sessionOtp && $sessionOtp == $request->post('otp')) {
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid OTP']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'member_code' => 'required',
            'password' => 'required|min:6'
        ]);

        $member = Member::where('member_code', $request->post('member_code'))->first();

        if (!$member) {
            return response()->json(['status' => 'error', 'message' => 'User not found.']);
        }

        $member->password = Hash::make($request->post('password'));
        $member->save();

        Session::forget('otp_' . $request->post('member_code'));
        return response()->json(['status' => 'success']);
    }

    private function maskEmail($email)
    {
        $parts = explode("@", $email);
        $name = substr($parts[0], 0, 3) . str_repeat("x", max(0, strlen($parts[0]) - 5)) . substr($parts[0], -1);
        $domain = substr($parts[1], 0, 1) . str_repeat("x", max(0, strpos($parts[1], '.') - 1)) . substr($parts[1], strpos($parts[1], '.'));
        return "{$name}@$domain";
    }

    /** Profile Upload */
    public function profileUpload(Request $request)
    {
        $btaAdmin = session()->get('btaMember');
        $memberId = $btaAdmin['memberId'] ?? null;

        if (!$memberId) {
            return response()->json([
                'status' => Constant::SUCCESS,
                'message' => 'Unauthorized access.'
            ]);
        }

        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $member = Member::find($memberId);

        if (!$member) {
            return response()->json([
                'status' => Constant::SUCCESS,
                'message' => 'Member not found.'
            ]);
        }

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads/profile_pictures/' . $filename;

            $file->move(public_path('uploads/profile_pictures'), $filename);

            // Update profile picture
            $member->member_portal_profile_picture = $filePath;
            $member->save();

            return response()->json([
                'status' => Constant::SUCCESS,
                'message' => 'Profile picture updated successfully.',
                'profile_picture' => asset($filePath)
            ]);
        }

        return response()->json([
            'status' => Constant::SUCCESS,
            'message' => 'No file uploaded.'
        ]);
    }

}
