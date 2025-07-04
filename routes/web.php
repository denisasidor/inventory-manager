<?php

use App\Http\Controllers\InvitedRegisterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\InviteRegisterController;
use App\Http\Controllers\InvitedRegistrationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/invitation/register/{token}', [InvitedRegisterController::class, 'showForm'])->name('register.invited');

Route::post('/invitation/register/{token}', [InvitedRegisterController::class, 'register'])->name('register.invited.submit');

