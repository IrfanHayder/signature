<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $check = $request->cookie('admin_hash');
        $user = User::where('hash', $check)->first();
        // dd($user ,$check  );
        if (($user != null) && ($check != null)) {
            return $next($request);
        } else {
            Cookie::queue(Cookie::forget('admin_hash'));
            if (auth()->check()) {
                Auth::logout();
            }
            return redirect()->to('/');
        }
    }
}
