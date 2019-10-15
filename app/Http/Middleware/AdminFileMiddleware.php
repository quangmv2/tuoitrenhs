<?php

namespace App\Http\Middleware;

use Closure;

use App\User;
use App\RoleRelationship;

class AdminFileMiddleware
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
            $temp = User::where('username', '=', $acc->username)->get()[0];
            if ($temp->active < 1) return redirect()->route('getChangePass')->with('notification', 'Đổi mật khẩu để kích hoạt tài khoản.');
            if ($temp->password != $acc->password) goto exitMD;
            if ($acc->type == 1) {
                return $next($request);
            }
            $arr = RoleRelationship::where('username', '=', $acc->username)->where('role_id', '=', '9')->get();
            if (count($arr) > 0) {
                return $next($request);
            }

        } 

        exitMD: return redirect()->route('adminHome')->with('notification', 'Bạn không có quyền truy cập chức năng quản lý Tập tin.');
    }
}
