<?php

use App\NativeComponents\ChatScreen;
use App\NativeComponents\LoginScreen;
use App\NativeComponents\RegistrationScreen;
use App\NativeComponents\UsersList;
use App\NativeComponents\WelcomeScreen;
use Illuminate\Support\Facades\Route;

Route::native('/', LoginScreen::class);
Route::native('/mobile/login', LoginScreen::class)->middleware('guest');
Route::native('/mobile/register', RegistrationScreen::class)->middleware('guest');
Route::native('/mobile/users', UsersList::class)->middleware('auth')->name('mobile.welcome');
Route::native('/mobile/chat/{user}',ChatScreen::class)->middleware('auth');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
