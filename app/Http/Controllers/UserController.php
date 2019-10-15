<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use App\Mail\Register;

use App\User;
use App\Profile;
use App\RoleRelationship;

class UserController extends Controller
{

    function getLogin(Request $request)
    {
        if ($request->session()->has('account')){
            $acc = $request->session()->get('account');
            $temp = User::where('username', '=', $acc->username)->get()[0];
            if ($temp->password != $acc->password) {
                $request->session()->forget('account');
                return redirect()->route('getLogin');
            };
            $arr = RoleRelationship::where('username', '=', $acc->username)->get();
            if ($acc->type == 1 || count($arr) > 0) {
                return redirect()->route('adminHome');
            }

        }
    	return view('login');
    }

    function postLogin(Request $request)
    {
    	$this->validate($request, [
    		'username'=>'required',
    		'password'=>'required|min:8'
    	], 
    	[
    		'username.required'=>'Bạn chưa nhập tên đăng nhập',
    		'password.required'=>'Bạn chưa nhập mật khẩu',
    		'password.min'=>'Mật khẩu không ít 8 kí tự'
    	]);


        $data = ['username' => $request->username, 'password' => $request->password];
        $auth = Auth::attempt($data);
    	if ($auth){
            $request->session()->put('account', Auth::user());
    		return redirect()->route('adminHome');
    	} else{
    		return redirect()->route('getLogin')->with('notification', "Đăng nhập không thành công");
    	}
    	
    }

    function getRegister(Request $request)
    {
        if ($request->session()->has('account')){
            $acc = $request->session()->get('account');
            $temp = User::where('username', '=', $acc->username)->get()[0];
            if ($temp->password != $acc->password) {
                $request->session()->forget('account');
                return redirect()->route('getLogin');
            };
            $arr = RoleRelationship::where('username', '=', $acc->username)->get();
            if ($acc->type == 1 || count($arr) > 0) {
                return redirect()->route('adminHome');
            }

        }
        return view('register');
    }

    function postRegister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'required|regex:/(0)[0-9]{9}/',
            'email' => 'required|email|unique:profile',
            'address' => 'required',

        ], 
        [

            'name.required' => 'Bạn chưa điền họ và tên',
            'phone_number.required' => 'Bạn chưa nhập số điện thoại',
            'phone_number.regex' => 'Số điện thoại có ít nhất 10 số',
            'email.required' => 'Bạn chưa nhập số email',
            'email.email' => 'Email sai định dạng',
            'email.unique' => 'Email đã đăng ký',
            'address.required' => 'Bạn chưa nhập địa chỉ',

        ]);
        
        $rd = Str::random(9);
        $acc =createAccount($request->input('name'));
        $user = new User;
        $user->username = $acc;
        $user->password = password_hash($rd, PASSWORD_BCRYPT);
        $user->active = 0;
        $user->status = 0;
        $user->type = 0;
        $user->save();

        $profile = new Profile;
        $profile->name = $request->input('name');
        $profile->phone_number = $request->input('phone_number');
        $profile->email = $request->input('email');
        $profile->address = $request->input('address');
        $profile->username_profile = $acc;
        $profile->save();

        $ad = User::where('type', 1)->where('username', '<>', 'admin')->get();
        $arr = (object) ['view' => 'admin.mail.register'];
        foreach ($ad as $value) {
            Mail::to($value->profile->email)->queue(new Register($arr));
        }

        $arr = (object) ['view'=>'client.mail.register', 'name' => $request->input('name')];

        Mail::to($request->input('email'))->queue(new Register($arr));

        

        return redirect()->route('getLogin')->with('notification', "Email sẽ sớm được gửi cho bạn khi tài khoản được admin phê duyệt.");
    }

    function logout(Request $request)
    {
    	$request->session()->forget('account');
    	return redirect()->route('getLogin');
    }
}
