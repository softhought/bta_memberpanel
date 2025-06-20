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
            $session['captchaSum'] = $operand1 + $operand2;
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
            $session['captchaSum'] = $operand1 + $operand2;
            session(['captcha_result' => $session]);

            return view('member.login', $data);
        }
    }

    public function auth(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required',
                'password' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['msg_status' => 0, 'errors' => $validator->errors()]);
        } else {
            $username = $request->post('username');
            $password = $request->post('password');
            $result = User::where(['user_name' => $username, 'is_active' => 'Y', 'web_role_id' => 1])->first();

            if ($result) {
                if (md5($password) === $result->password) {
                    $user_id = $result->id;
                    $userName = $result->name;

                    $user = User::with('role')->find($user_id);
                    $role = $user->role->role;
                    $role_id = $user->role->id;

                    $user->is_online = 1;
                    $user->save();

                    $result = ['userId' => $user_id, 'userName' => $userName, 'role' => $role, 'roleId' => $role_id];
                    $this->setSessionData($result);

                    return response()->json(['msg_status' => 1, 'msg_data' => 'Login successfully']);
                } else {
                    return response()->json(['msg_status' => 2, 'msg_data' => 'Please enter correct password']);
                }
            } else {
                return response()->json(['msg_status' => 2, 'msg_data' => 'Please enter valid login details']);
            }
        }
    }

    public function memberAuth(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'member_code' => 'required',
                'password' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['msg_status' => 0, 'errors' => $validator->errors()]);
        } else {
            $memberCode = $request->post('member_code');
            $password = $request->post('password');
            $result = Member::where(['member_code' => $memberCode])->first();

            if ($result) {
                if (Hash::check($password, $result->password)) {
                    $memberId = $result->member_id;
                    $userName = "{$result->member_fname} {$result->member_lname}";

                    $roleModel = Role::find(2);
                    $role = $roleModel->role;
                    $role_id = $roleModel->id;

                    $result = ['memberId' => $memberId, 'userName' => $userName, 'role' => $role, 'roleId' => $role_id];
                    $this->setMemberSessionData($result);

                    return response()->json(['msg_status' => 1, 'msg_data' => 'Login successfully']);
                } else {
                    return response()->json(['msg_status' => 2, 'msg_data' => 'Please enter correct password']);
                }
            } else {
                return response()->json(['msg_status' => 2, 'msg_data' => 'Please enter valid login details']);
            }
        }
    }

    public function logout($role)
    {
        $session = $role == 1 ? 'btaAdmin' : 'btaMember';
        $redirect = $session == 'btaAdmin' ? 'admin' : 'member';

        session()->forget($session);
        session()->flash('logout', 'Logout sucessfully');
        return redirect($redirect);
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
        $result['captchaSum'] = $operand1 + $operand2;

        session()->forget('captcha_result');
        session(['captcha_result' => $result]);

        return response()->json($data);
    }
}
