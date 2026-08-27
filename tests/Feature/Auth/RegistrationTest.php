<?php

use App\Models\User;
use App\NativeComponents\RegistrationScreen;
use Laravel\Fortify\Features;

beforeEach(function () {
    $this->skipUnlessFortifyHas(Features::registration());
});

test('registration screen can be rendered', function () {
    $response = $this->get(route('register'));

    $response->assertOk();
});

test('new users can register', function () {
    $response = $this->post(route('register.store'), [
        'name' => 'John Doe',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertSessionHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});

test('native registration inserts a user', function () {
    $screen = new RegistrationScreen;
    $screen->name = 'Jane Doe';
    $screen->email = 'jane@example.com';
    $screen->password = 'password';
    $screen->confirmPassword = 'password';

    $screen->register();

    expect(User::where('email', 'jane@example.com')->exists())->toBeTrue();
});

test('native registration validates confirm password while typing', function () {
    $screen = new RegistrationScreen;
    $screen->password = 'password';

    $screen->updatedConfirmPassword('different-password');

    expect($screen->confirmPasswordError)->toBe('The passwords do not match.');

    $screen->updatedConfirmPassword('password');

    expect($screen->confirmPasswordError)->toBe('');
});
