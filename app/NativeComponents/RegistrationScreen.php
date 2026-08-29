<?php

namespace App\NativeComponents;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;

class RegistrationScreen extends NativeComponent
{
    use PasswordValidationRules, ProfileValidationRules;

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $confirmPassword = '';

    public string $nameError = '';

    public string $emailError = '';

    public string $passwordError = '';

    public string $confirmPasswordError = '';

    public function updatedConfirmPassword(string $value): void
    {
        $this->confirmPassword = $value;
        $this->validateConfirmPassword();
    }

    public function updatedPassword(string $value): void
    {
        $this->password = $value;

        if ($this->confirmPassword !== '') {
            $this->validateConfirmPassword();
        }
    }

    public function register(): void
    {
        $this->clearErrors();

        $validator = Validator::make(
            [
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->confirmPassword,
            ],
            [
                ...$this->profileRules(),
                'password' => $this->passwordRules(),
                'password_confirmation' => ['same:password'],
            ],
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $this->nameError = $errors->first('name');
            $this->emailError = $errors->first('email');
            $this->passwordError = $errors->first('password');
            $this->confirmPasswordError = $errors->first('password_confirmation')
                ?: ($this->password !== $this->confirmPassword
                    ? 'The passwords do not match.'
                    : '');

            return;
        }

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        Auth::login($user);
        request()->session()->regenerate();
        $this->replace('/mobile/welcome');
    }

    public function showLogin(): void
    {
        $this->replace('/mobile/login');
    }

    private function validateConfirmPassword(): void
    {
        $this->confirmPasswordError = $this->confirmPassword === $this->password
            ? ''
            : 'The passwords do not match.';
    }

    private function clearErrors(): void
    {
        $this->nameError = '';
        $this->emailError = '';
        $this->passwordError = '';
        $this->confirmPasswordError = '';
    }

    public function render(): View
    {
        return view('native.registration-screen');
    }
}
