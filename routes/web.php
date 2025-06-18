<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard (Authenticated + Verified Users)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated User Profile Management (Laravel Breeze default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
         ->name('password.request');
         
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
         ->name('password.email');
         
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
         ->name('password.reset');
         
    Route::post('/reset-password', [NewPasswordController::class, 'store'])
         ->name('password.update');
});
Route::middleware([AdminMiddleware::class, 'auth'])->group(function () {
    Route::resource('admin', AdminController::class);
});

// User self-view/edit routes (only for authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user', [UserController::class, 'update'])->name('user.update');
});

require __DIR__.'/auth.php';
