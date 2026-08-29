<?php

namespace App\NativeComponents;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;

class WelcomeScreen extends NativeComponent
{
    public function logout(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        $this->replace('/mobile/login');
    }

    public function render(): View
    {
        return view('native.welcome-screen');
    }
}
