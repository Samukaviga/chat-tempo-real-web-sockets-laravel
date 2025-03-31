<?php

use App\Events\UserStatusEvent;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');



Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/logout', function () {

    $user = auth()->user();
    $user->update(['status' => 0]);

    UserStatusEvent::dispatch(Auth::user()->id, 0);

    Auth::logout();
    return redirect()->route('login');
})->name('logout');


require __DIR__ . '/auth.php';
