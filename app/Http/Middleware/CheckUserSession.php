<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserSession
{
    public function handle(Request $request, Closure $next)
    {

        $data = session('user_data');
        $url = session('agency_full_url');

        if (empty($data)) {
            return redirect()->to($url ?: route('login'));
        }

        return $next($request);
    }
}
