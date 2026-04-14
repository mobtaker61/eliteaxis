<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function showLogin(string $locale, Request $request): View
    {
        if (! $request->session()->has('admin_captcha')) {
            $this->regenerateCaptcha($request);
        }

        return view('admin.auth.login', [
            'captchaCode' => $request->session()->get('admin_captcha'),
        ]);
    }

    public function login(string $locale, Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            'captcha' => ['required', 'string'],
        ]);

        $username = (string) $request->input('username');
        $password = (string) $request->input('password');
        $captcha = strtoupper(trim((string) $request->input('captcha')));
        $sessionCaptcha = strtoupper((string) $request->session()->get('admin_captcha', ''));

        $validUsername = (string) config('admin.username');
        $validPassword = (string) config('admin.password');

        $isValid = hash_equals($validUsername, $username)
            && hash_equals($validPassword, $password)
            && hash_equals($sessionCaptcha, $captcha);

        if (! $isValid) {
            $this->regenerateCaptcha($request);

            return back()->withErrors([
                'login' => 'Invalid credentials or captcha.',
            ])->withInput($request->except('password'));
        }

        $request->session()->put('admin_authenticated', true);
        $this->regenerateCaptcha($request);

        return redirect()->route('admin.dashboard', ['locale' => $locale]);
    }

    public function logout(string $locale, Request $request): RedirectResponse
    {
        $request->session()->forget('admin_authenticated');
        $this->regenerateCaptcha($request);

        return redirect()->route('admin.login', ['locale' => $locale]);
    }

    public function refreshCaptcha(string $locale, Request $request): RedirectResponse
    {
        $this->regenerateCaptcha($request);

        return back();
    }

    private function regenerateCaptcha(Request $request): void
    {
        $request->session()->put('admin_captcha', strtoupper(Str::random(5)));
    }
}
