<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TwoFAController extends Controller
{
    protected $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    /**
     * Show 2FA setup page.
     *
     * @return \Illuminate\View\View
     */
    public function showSetup()
    {
        $user = Auth::user();

        // Check if 2FA is already enabled
        if ($user->google2fa_enabled) {
            return redirect()->route('dashboard')
                ->with('info', 'Two-factor authentication is already enabled.');
        }

        // Generate new secret
        $secret = $this->google2fa->generateSecretKey();
        $user->google2fa_secret = $secret;
        $user->save();

        // Generate QR code URL
        $appName = config('app.name');
        $qrCodeUrl = $this->google2fa->getQRCodeUrl(
            $appName,
            $user->username,
            $secret
        );

        return view('auth.2fa-setup', compact('qrCodeUrl', 'secret'));
    }

    /**
     * Enable 2FA for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enable(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);

        $user = Auth::user();

        // Verify the code
        if (!$this->google2fa->verifyKey($user->google2fa_secret, $request->code)) {
            return back()->withErrors([
                'code' => 'Invalid authentication code. Please try again.',
            ]);
        }

        // Enable 2FA
        $user->google2fa_enabled = true;
        $user->save();

        return redirect()->route('dashboard')
            ->with('success', 'Two-factor authentication has been enabled successfully.');
    }

    /**
     * Show 2FA disable confirmation page.
     *
     * @return \Illuminate\View\View
     */
    public function showDisable()
    {
        $user = Auth::user();

        if (!$user->google2fa_enabled) {
            return redirect()->route('dashboard')
                ->with('info', 'Two-factor authentication is not enabled.');
        }

        return view('auth.2fa-disable');
    }

    /**
     * Disable 2FA for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disable(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);

        $user = Auth::user();

        // Verify the code before disabling
        if (!$this->google2fa->verifyKey($user->google2fa_secret, $request->code)) {
            return back()->withErrors([
                'code' => 'Invalid authentication code. Please try again.',
            ]);
        }

        // Disable 2FA
        $user->google2fa_enabled = false;
        $user->google2fa_secret = null;
        $user->save();

        return redirect()->route('dashboard')
            ->with('success', 'Two-factor authentication has been disabled successfully.');
    }

    /**
     * Verify 2FA code during login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);

        $user = Auth::user();

        if (!$user->google2fa_enabled) {
            return redirect()->route('dashboard');
        }

        // Verify the code
        if (!$this->google2fa->verifyKey($user->google2fa_secret, $request->code)) {
            return back()->withErrors([
                'code' => 'Invalid authentication code. Please try again.',
            ]);
        }

        // Mark 2FA as verified in session
        session()->put('2fa_verified', true);

        return redirect()->route('dashboard');
    }
}
