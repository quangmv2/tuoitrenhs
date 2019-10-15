<?php

namespace App\Http\Middleware;

use Closure;

class AdminInformationMiddleware
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
        if ($request->session()->has('account')) {
            if ($request->session()->get('account')->type == 1)
                return $next($request);
        }
        return redirect()->route('adminHome')->with('notification', 'Bạn không có quyền truy cập chức năng quản lý Thông tin.');
    }
}
