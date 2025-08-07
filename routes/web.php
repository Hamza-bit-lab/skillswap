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
| routes are loaded by the RouteServiceProvider and all of them will
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

    

// Password Reset Routes
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
Route::get('/redirect', [RedirectController::class, 'afterLogin'])->name('redirect')->middleware('auth');

// User Routes (Regular users only)
Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', function () {
            // Redirect admins to admin dashboard
            if (auth()->check() && auth()->user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            return view('user-side.dashboard');
        })->name('user.dashboard');

        // Exchange Routes
        Route::prefix('exchanges')->group(function () {
            Route::get('/', [App\Http\Controllers\ExchangeController::class, 'index'])->name('user.exchanges.discover');
            Route::get('/skill/{id}', [App\Http\Controllers\SkillController::class, 'showSkill'])->name('user.exchanges.skill-details');
            Route::get('/create', [App\Http\Controllers\ExchangeController::class, 'create'])->name('user.exchanges.create');
            Route::post('/', [App\Http\Controllers\ExchangeController::class, 'store'])->name('user.exchanges.store');
            Route::get('/quick-exchange/{skillId}', [App\Http\Controllers\ExchangeController::class, 'showQuickExchange'])->name('user.exchanges.quick-exchange');
            Route::post('/quick-exchange', [App\Http\Controllers\ExchangeController::class, 'storeQuickExchange'])->name('user.exchanges.quick-exchange.store');
            Route::get('/my-exchanges', [App\Http\Controllers\ExchangeController::class, 'myExchanges'])->name('user.exchanges.my-exchanges');
            Route::get('/{id}', [App\Http\Controllers\ExchangeController::class, 'show'])->name('user.exchanges.show');
            Route::post('/{id}/accept', [App\Http\Controllers\ExchangeController::class, 'accept'])->name('user.exchanges.accept');
            Route::post('/{id}/reject', [App\Http\Controllers\ExchangeController::class, 'reject'])->name('user.exchanges.reject');
            Route::post('/{id}/complete', [App\Http\Controllers\ExchangeController::class, 'complete'])->name('user.exchanges.complete');
            Route::post('/{id}/cancel', [App\Http\Controllers\ExchangeController::class, 'cancel'])->name('user.exchanges.cancel');
            Route::post('/{id}/message', [App\Http\Controllers\ExchangeController::class, 'sendMessage'])->name('user.exchanges.message');
            Route::post('/exchanges/{id}/mark-done', [App\Http\Controllers\ExchangeController::class, 'markAsDone'])->name('user.exchanges.mark-done');
            Route::get('/search', [App\Http\Controllers\ExchangeController::class, 'search'])->name('user.exchanges.search');
            
            // Chat Routes
            Route::get('/{id}/messages', [App\Http\Controllers\ChatController::class, 'getMessages'])->name('user.chat.messages');
            Route::post('/{id}/messages', [App\Http\Controllers\ChatController::class, 'sendMessage'])->name('user.chat.send');
            Route::post('/{id}/messages/read', [App\Http\Controllers\ChatController::class, 'markAsRead'])->name('user.chat.read');
            Route::get('/messages/unread', [App\Http\Controllers\ChatController::class, 'getUnreadCount'])->name('user.chat.unread');
            Route::get('/messages/latest-unread', [App\Http\Controllers\ChatController::class, 'getLatestUnreadMessage'])->name('user.chat.latest-unread');
            Route::get('/messages', [App\Http\Controllers\MessagesController::class, 'index'])->name('user.messages');
            Route::get('/messages/recent', [App\Http\Controllers\ChatController::class, 'getRecentMessages'])->name('user.chat.recent');
            Route::get('/chats/exchanges', [App\Http\Controllers\ChatController::class, 'getExchangeChats'])->name('user.chat.exchanges');
            Route::post('/{id}/typing', [App\Http\Controllers\ChatController::class, 'sendTypingIndicator'])->name('user.chat.typing');
            Route::delete('/messages/{id}', [App\Http\Controllers\ChatController::class, 'deleteMessage'])->name('user.chat.delete');
            Route::get('/{id}/messages/search', [App\Http\Controllers\ChatController::class, 'searchMessages'])->name('user.chat.search');
            Route::get('/{id}/messages/stats', [App\Http\Controllers\ChatController::class, 'getMessageStats'])->name('user.chat.stats');
            
            // User-based messaging routes
            Route::get('/messages/user/{userId}', [App\Http\Controllers\ChatController::class, 'getUserMessages'])->name('user.chat.user.messages');
            Route::post('/messages/user/{userId}/read', [App\Http\Controllers\ChatController::class, 'markUserMessagesAsRead'])->name('user.chat.user.read');
            Route::post('/messages/user/{userId}/send', [App\Http\Controllers\ChatController::class, 'sendUserMessage'])->name('user.chat.user.send');

            Route::get('/recommendations', [App\Http\Controllers\ExchangeController::class, 'getRecommendations'])->name('user.exchanges.recommendations');
        });

        // Profile Routes
        Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('user.profile');
        Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('user.profile.edit');
        Route::put('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('user.profile.update');
        Route::post('/profile/avatar', [App\Http\Controllers\ProfileController::class, 'updateAvatar'])->name('user.profile.avatar');
        
        // Skills Routes
        Route::post('/profile/skills', [App\Http\Controllers\ProfileController::class, 'addSkill'])->name('user.skills.add');
        Route::get('/profile/skills/{skill}/edit', [App\Http\Controllers\ProfileController::class, 'editSkill'])->name('user.skills.edit');
        Route::put('/profile/skills/{skill}', [App\Http\Controllers\ProfileController::class, 'updateSkill'])->name('user.skills.update');
        Route::delete('/profile/skills/{skill}', [App\Http\Controllers\ProfileController::class, 'deleteSkill'])->name('user.skills.delete');
        
        // Portfolio Routes
        Route::post('/profile/portfolio', [App\Http\Controllers\ProfileController::class, 'addPortfolioItem'])->name('user.portfolio.add');
        Route::delete('/profile/portfolio/{id}', [App\Http\Controllers\ProfileController::class, 'deletePortfolioItem'])->name('user.portfolio.delete');

        Route::get('/messages', function () {
            return view('user-side.messages');
        })->name('user.messages');
        
        Route::get('/chat', function () {
            return view('user-side.chat');
        })->name('user.chat');
        
        Route::get('/chat-debug', function () {
            return view('user-side.chat-debug');
        })->name('user.chat.debug');

        Route::get('/skills', function () {
            return view('user-side.skills');
        })->name('user.skills');
        
        // My Exchanges Page
        Route::get('/dashboard/my-exchanges', function () {
            return redirect('/dashboard/exchanges/my-exchanges');
        });
        
        // My Skills Page
        Route::get('/my-skills', function () {
            return view('user-side.my-skills');
        })->name('user.my-skills');
        
        // Favorites Page
        Route::get('/favorites', function () {
            return view('user-side.favorites');
        })->name('user.favorites');
        
        // Settings Page
        Route::get('/settings', function () {
            return view('user-side.settings');
        })->name('user.settings');
    });

    // Admin Routes
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
        Route::get('/skills', [App\Http\Controllers\AdminController::class, 'skills'])->name('admin.skills');
        Route::get('/exchanges', [App\Http\Controllers\AdminController::class, 'exchanges'])->name('admin.exchanges');
        Route::get('/reports', [App\Http\Controllers\AdminController::class, 'reports'])->name('admin.reports');
        Route::get('/settings', [App\Http\Controllers\AdminController::class, 'settings'])->name('admin.settings');
        
        // Skills management routes
        Route::get('/skills/{id}', [App\Http\Controllers\AdminController::class, 'getSkill'])->name('admin.skills.show');
        Route::post('/skills/{id}/approve', [App\Http\Controllers\AdminController::class, 'approveSkill'])->name('admin.skills.approve');
        Route::post('/skills/{id}/reject', [App\Http\Controllers\AdminController::class, 'rejectSkill'])->name('admin.skills.reject');
        Route::post('/skills/bulk-approve', [App\Http\Controllers\AdminController::class, 'bulkApproveSkills'])->name('admin.skills.bulk-approve');
        Route::post('/skills/bulk-reject', [App\Http\Controllers\AdminController::class, 'bulkRejectSkills'])->name('admin.skills.bulk-reject');
        Route::get('/skills/export', [App\Http\Controllers\AdminController::class, 'exportSkills'])->name('admin.skills.export');
        
        // Users management routes
        Route::get('/users/{id}', [App\Http\Controllers\AdminController::class, 'getUser'])->name('admin.users.show');
        Route::post('/users/{id}/suspend', [App\Http\Controllers\AdminController::class, 'suspendUser'])->name('admin.users.suspend');
        Route::post('/users/{id}/activate', [App\Http\Controllers\AdminController::class, 'activateUser'])->name('admin.users.activate');
        Route::post('/users/bulk-activate', [App\Http\Controllers\AdminController::class, 'bulkActivateUsers'])->name('admin.users.bulk-activate');
        Route::post('/users/bulk-suspend', [App\Http\Controllers\AdminController::class, 'bulkSuspendUsers'])->name('admin.users.bulk-suspend');
        Route::post('/users/{id}/message', [App\Http\Controllers\AdminController::class, 'sendUserMessage'])->name('admin.users.message');
        Route::get('/users/export', [App\Http\Controllers\AdminController::class, 'exportUsers'])->name('admin.users.export');
        
        // Exchanges management routes
        Route::get('/exchanges/{id}', [App\Http\Controllers\AdminController::class, 'getExchange'])->name('admin.exchanges.show');
        Route::post('/exchanges/{id}/approve', [App\Http\Controllers\AdminController::class, 'approveExchange'])->name('admin.exchanges.approve');
        Route::post('/exchanges/{id}/reject', [App\Http\Controllers\AdminController::class, 'rejectExchange'])->name('admin.exchanges.reject');
        Route::post('/exchanges/{id}/pause', [App\Http\Controllers\AdminController::class, 'pauseExchange'])->name('admin.exchanges.pause');
        Route::post('/exchanges/{id}/complete', [App\Http\Controllers\AdminController::class, 'completeExchange'])->name('admin.exchanges.complete');
        Route::post('/exchanges/bulk-approve', [App\Http\Controllers\AdminController::class, 'bulkApproveExchanges'])->name('admin.exchanges.bulk-approve');
        Route::post('/exchanges/bulk-reject', [App\Http\Controllers\AdminController::class, 'bulkRejectExchanges'])->name('admin.exchanges.bulk-reject');
        Route::post('/exchanges/bulk-complete', [App\Http\Controllers\AdminController::class, 'bulkCompleteExchanges'])->name('admin.exchanges.bulk-complete');
        Route::post('/exchanges/{id}/message', [App\Http\Controllers\AdminController::class, 'sendExchangeMessage'])->name('admin.exchanges.message');
        Route::get('/exchanges/export', [App\Http\Controllers\AdminController::class, 'exportExchanges'])->name('admin.exchanges.export');
        
        // Reviews management routes
        Route::get('/reviews', [App\Http\Controllers\AdminController::class, 'reviews'])->name('admin.reviews');
        Route::get('/reviews/{id}', [App\Http\Controllers\AdminController::class, 'getReview'])->name('admin.reviews.show');
        Route::post('/reviews/{id}/approve', [App\Http\Controllers\AdminController::class, 'approveReview'])->name('admin.reviews.approve');
        Route::post('/reviews/{id}/reject', [App\Http\Controllers\AdminController::class, 'rejectReview'])->name('admin.reviews.reject');
        Route::post('/reviews/bulk-approve', [App\Http\Controllers\AdminController::class, 'bulkApproveReviews'])->name('admin.reviews.bulk-approve');
        Route::post('/reviews/bulk-reject', [App\Http\Controllers\AdminController::class, 'bulkRejectReviews'])->name('admin.reviews.bulk-reject');
        Route::get('/reviews/export', [App\Http\Controllers\AdminController::class, 'exportReviews'])->name('admin.reviews.export');
    });
});

// Redirect old routes to new structure
Route::get('/home', function () {
    return redirect()->route(auth()->check() && auth()->user()->isAdmin() ? 'admin.dashboard' : 'user.dashboard');
})->middleware('auth');

Route::get('/user/home', function () {
    return redirect()->route('user.dashboard');
})->middleware('auth');

// User profile (public, by username)
Route::get('/profile/{user:username}', [App\Http\Controllers\ProfileController::class, 'showPublic'])->name('user.profile.public');