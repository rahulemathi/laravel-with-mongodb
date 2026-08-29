<?php

namespace App\NativeComponents;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;

class LoginScreen extends NativeComponent
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    public string $emailError = '';

    public string $passwordError = '';

    public string $loginError = '';

    public function mount(): void
    {
        if (Auth::check()) {
            $this->replace('/mobile/welcome');
        }
    }

    public function login(): void
    {
        $this->clearErrors();

        $validator = Validator::make([
            'email' => $this->email,
            'password' => $this->password,
        ], [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $this->emailError = $errors->first('email');
            $this->passwordError = $errors->first('password');

            return;
        }

        if (! Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember)) {
            $this->loginError = 'These credentials do not match our records.';

            return;
        }

        request()->session()->regenerate();
        $this->replace('/mobile/users');
    }

    public function showRegistration(): void
    {
        $this->replace('/mobile/register');
    }

    private function clearErrors(): void
    {
        $this->emailError = '';
        $this->passwordError = '';
        $this->loginError = '';
    }

    public function render(): View
    {
        return view('native.login-screen');
    }
}
