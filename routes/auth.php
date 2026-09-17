<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| RUTE KHUSUS PENGUNJUNG TAMU (GUEST ONLY)
|--------------------------------------------------------------------------
| Rute yang hanya dapat diakses saat pengguna BELUM login.
| Jika sudah login, sistem akan otomatis mengarahkan ke dashboard.
*/
Route::middleware('guest')->group(function () {

    // Registrasi Akun Pengguna Baru
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    // Autentikasi / Masuk Akun (Login)
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Permohonan Tautan Reset Kata Sandi (Forgot Password)
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    // Penyetelan Kata Sandi Baru dengan Token Validasi (Reset Password)
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

/*
|--------------------------------------------------------------------------
| RUTE KHUSUS PENGGUNA TEROTENTIKASI (AUTHENTICATED ONLY)
|--------------------------------------------------------------------------
| Rute yang hanya dapat diakses saat staf / admin SUDAH login.
*/
Route::middleware('auth')->group(function () {

    // Verifikasi Alamat Email
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Konfirmasi Kata Sandi untuk Tindakan Sensitif
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Pembaruan Kata Sandi
    Route::put('password', [PasswordController::class, 'update'])
        ->name('password.update');

    // Keluar Akun (Logout Sesi)
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
