<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\RegistrationWizardController;
use App\Http\Controllers\OtpVerificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by theRouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Landing Page (Before Login)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Guest Routes (Only accessible when NOT logged in)
Route::middleware(['guest'])->group(function () {
    // Registration Wizard Routes
    Route::prefix('register')->group(function () {
        Route::get('/', [RegistrationWizardController::class, 'showStep1'])->name('register.step1');
        Route::post('/step1', [RegistrationWizardController::class, 'storeStep1'])->name('register.step1.store');
        Route::get('/step2', [RegistrationWizardController::class, 'showStep2'])->name('register.step2');
        Route::post('/step2', [RegistrationWizardController::class, 'storeStep2'])->name('register.step2.store');
        Route::get('/step3', [RegistrationWizardController::class, 'showStep3'])->name('register.step3');
        Route::post('/step3', [RegistrationWizardController::class, 'storeStep3'])->name('register.step3.store');
        Route::get('/step4', [RegistrationWizardController::class, 'showStep4'])->name('register.step4');
        Route::post('/step4', [RegistrationWizardController::class, 'storeStep4'])->name('register.step4.store');
        Route::get('/back/{step}', [RegistrationWizardController::class, 'goBack'])->name('register.back');
    });

    // Authentication Routes
    Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
});

// Logout Route (Only accessible when logged in)
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Password Reset Routes (using guest middleware for consistency)
Route::middleware(['guest'])->group(function () {
    Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
});

// OTP Email Verification Routes
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [OtpVerificationController::class, 'showVerificationForm'])->name('verification.notice');
    Route::post('/email/verify/send', [OtpVerificationController::class, 'sendOtp'])->name('otp.send');
    Route::post('/email/verify', [OtpVerificationController::class, 'verifyOtp'])->name('otp.verify');
    Route::post('/email/verify/resend', [OtpVerificationController::class, 'resendOtp'])->name('otp.resend');
});

// Post-login redirect
Route::get('/redirect', [RedirectController::class, 'afterLogin'])->name('redirect');

// User Routes (Regular users only)
Route::middleware(['auth'])->group(function () {
    
    // User Dashboard Routes
    Route::prefix('dashboard')->group(function () {
        Route::get('/', function () {
            return view('user-side.dashboard');
        })->name('user.dashboard');
        
        Route::get('/exchanges', function () {
            return view('user-side.exchanges');
        })->name('user.exchanges');
        
        Route::get('/profile', function () {
            return view('user-side.profile');
        })->name('user.profile');
        
        Route::get('/messages', function () {
            return view('user-side.messages');
        })->name('user.messages');
        
        Route::get('/skills', function () {
            return view('user-side.skills');
        })->name('user.skills');
    });
    
    // Admin Routes
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/', function () {
            return view('admin-side.dashboard');
        })->name('admin.dashboard');
        
        Route::get('/dashboard', function () {
            return view('admin-side.dashboard');
        })->name('admin.dashboard');
        
        Route::get('/users', function () {
            return view('admin-side.users');
        })->name('admin.users');
        
        Route::get('/exchanges', function () {
            return view('admin-side.exchanges');
        })->name('admin.exchanges');
        
        Route::get('/reports', function () {
            return view('admin-side.reports');
        })->name('admin.reports');
    });
});

// Redirect old routes to new structure
Route::get('/home', function () {
    return redirect()->route('user.dashboard');
});

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

// Handle any remaining home route conflicts
Route::get('/user/home', function () {
    return redirect()->route('user.dashboard');
});