<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('btaAdmin.userId')) {
            return redirect('admin.dashboard');
        } else {
            $operand1 = rand(1, 10);
            $operand2 = rand(1, 10);

            $data['operand1'] = $operand1;
            $data['operand2'] = $operand2;

            $session = ['captchaSum' => $operand1 + $operand2];
            session(['captcha_result' => $session]);

            return view('admin.login', $data);
        }
    }

    public function member(Request $request)
    {
        if ($request->session()->has('btaMember.memberId')) {
            return redirect('member/dashboard');
        } else {
            $operand1 = rand(1, 10);
            $operand2 = rand(1, 10);

            $data['operand1'] = $operand1;
            $data['operand2'] = $operand2;

            $session = ['captchaSum' => $operand1 + $operand2];
            session(['captcha_result' => $session]);

            return view('member.login', $data);
        }
    }

    public function auth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['msg_status' => 0, 'errors' => $validator->errors()]);
        }

        $username = $request->post('username');
        $password = $request->post('password');

        $result = User::where([
            'user_name' => $username,
            'is_active' => 'Y',
            'web_role_id' => 1
        ])->first();

        if ($result) {
            if (md5($password) === $result->password) {
                $userId = $result->id;
                $userName = $result->name;

                $user = User::with('role')->find($userId);
                $role = $user->role->role;
                $roleId = $user->role->id;

                $user->is_online = 1;
                $user->save();

                $sessionData = [
                    'userId' => $userId,
                    'userName' => $userName,
                    'role' => $role,
                    'roleId' => $roleId
                ];

                $this->setSessionData($sessionData);

                return response()->json(['msg_status' => 1, 'msg_data' => 'Login successfully']);
            } else {
                return response()->json(['msg_status' => 2, 'msg_data' => 'Please enter correct password']);
            }
        }

        return response()->json(['msg_status' => 2, 'msg_data' => 'Please enter valid login details']);
    }

    public function memberAuth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'member_code' => 'required',
            'password' => 'required'
        ], ['member_code.required' => 'The registration no field is required.']);

        if ($validator->fails()) {
            return response()->json(['msg_status' => 0, 'errors' => $validator->errors()]);
        }

        $memberCode = $request->post('member_code');
        $password = $request->post('password');

        $result = Member::where('member_code', $memberCode)->first();

        if ($result) {
            if (Hash::check($password, $result->password)) {
                $memberId = $result->member_id;
                $userName = $result->member_fname . ' ' . $result->member_lname;

                $roleModel = Role::find(2);
                $role = $roleModel ? $roleModel->role : '';
                $roleId = $roleModel ? $roleModel->id : null;

                $sessionData = [
                    'memberId' => $memberId,
                    'userName' => $userName,
                    'role' => $role,
                    'roleId' => $roleId
                ];

                $this->setMemberSessionData($sessionData);

                return response()->json(['msg_status' => 1, 'msg_data' => 'Login successfully']);
            } else {
                return response()->json(['msg_status' => 2, 'msg_data' => 'Please enter correct password']);
            }
        }

        return response()->json(['msg_status' => 2, 'msg_data' => 'Please enter valid login details']);
    }

    public function logout($role)
    {
        $sessionKey = ($role == 1) ? 'btaAdmin' : 'btaMember';
        $redirectTo = ($role == 1) ? 'admin' : 'member';

        session()->forget($sessionKey);
        session()->flash('logout', 'Logout successfully');

        return redirect($redirectTo);
    }

    private function setSessionData($result)
    {
        session(['btaAdmin' => $result]);
    }

    private function setMemberSessionData($result)
    {
        session(['btaMember' => $result]);
    }

    public function reloadCaptach()
    {
        $operand1 = rand(1, 10);
        $operand2 = rand(1, 10);

        $data['operand1'] = $operand1;
        $data['operand2'] = $operand2;

        $sessionData = ['captchaSum' => $operand1 + $operand2];

        session()->forget('captcha_result');
        session(['captcha_result' => $sessionData]);

        return response()->json($data);
    }
}
