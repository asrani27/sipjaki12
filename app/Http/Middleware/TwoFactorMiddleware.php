<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorMiddleware
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
        $user = Auth::user();

        // If user is not authenticated, let other middleware handle it
        if (!$user) {
            return $next($request);
        }

        // If user has 2FA enabled but hasn't verified, redirect to verification page
        if ($user->google2fa_enabled && !session()->get('2fa_verified')) {
            return redirect()->route('2fa.verify');
        }

        return $next($request);
    }
}
