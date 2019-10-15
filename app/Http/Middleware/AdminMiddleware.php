<?php

namespace App\Http\Middleware;

session_start();
use Illuminate\Support\Facades\Auth;

use App\User;
use App\RoleRelationship;

use Closure;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->session()->has('account')){
            $acc = $request->session()->get('account');
            $temp = User::where('username', '=', $acc->username)->get();
            if (count($temp) > 0){
                $temp = $temp[0];
            } else {
                $request->session()->forget('account');
                unset($_SESSION['use_ck']);
                unset($_SESSION['type_1']);
                goto exitMD;
            }
            if ($temp->password != $acc->password) {
                $request->session()->forget('account');
                unset($_SESSION['use_ck']);
                unset($_SESSION['type_1']);
                goto exitMD;
            }
            $request->session()->put('account', $temp);
            $acc = $temp;
            if ($acc->type == 1) {
                $_SESSION['use_ck'] = $temp;
                $_SESSION['type_1'] = 1;
                return $next($request);
            }
            $acc = $temp;
            if ($acc->status < 1) {
                $request->session()->forget('account');
                unset($_SESSION['use_ck']);
                unset($_SESSION['type_1']);
                return redirect()->route('getLogin')->with('notification', 'Tài khoản không còn hoạt động');
            } else {
                unset($_SESSION['type_1']);
            }

            $arr = RoleRelationship::where('username', '=', $acc->username)->where('role_id', '9')->get();

            if (count($arr) > 0) $_SESSION['use_ck'] = $temp;

            $arr = RoleRelationship::where('username', '=', $acc->username)->where('role_id', '2')->get();

            if (count($arr) > 0) $_SESSION['use_ck'] = $temp;



            $arr = RoleRelationship::where('username', '=', $acc->username)->get();

            if (count($arr) > 0) {
                $_SESSION['use_ck'] = $temp;
                return $next($request);
            }

        } 

        exitMD: return redirect()->route('getLogin')->with('notification', 'Bạn phải đăng nhập');
    
    }
}
