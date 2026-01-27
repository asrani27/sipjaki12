<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            // 'cf-turnstile-response' => ['required'],
        ]);

        // Validate Cloudflare Turnstile CAPTCHA
        // $turnstileResponse = $this->verifyTurnstile($request->input('cf-turnstile-response'));

        // if (!$turnstileResponse['success']) {
        //     return back()->withErrors([
        //         'captcha' => 'CAPTCHA verification failed. Please try again.',
        //     ])->withInput($request->except('password'));
        // }

        // Custom authentication using username instead of email
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $user = Auth::user();

            // Check if user has 2FA enabled
            // if ($user->google2fa_enabled) {
            //     // Redirect to 2FA verification page
            //     return redirect()->route('2fa.verify');
            // }

            // // Mark 2FA as verified for users without 2FA
            // session()->put('2fa_verified', true);

            return redirect('/dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput($request->except('password'));
    }

    /**
     * Verify Cloudflare Turnstile CAPTCHA response.
     *
     * @param  string  $token
     * @return array
     */
    protected function verifyTurnstile($token)
    {
        $response = \Illuminate\Support\Facades\Http::post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => env('TURNSTILE_SECRET_KEY'),
            'response' => $token,
            'remoteip' => request()->ip(),
        ]);

        return $response->json();
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
