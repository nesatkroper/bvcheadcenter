<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminIpMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $allowedIps = ['202.37.20.38']; // เปลี่ยนเป็น IP ที่คุณต้องการอนุญาต

        /*if (!in_array($request->ip(), $allowedIps)) {
            abort(403, 'Unauthorized access');
        }*/

        return $next($request);
    }
}