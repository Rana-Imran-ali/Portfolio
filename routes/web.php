<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\PageContentController;

// ─────────────────────────────────────────────────────────────────────────────
// Public Frontend Routes
// ─────────────────────────────────────────────────────────────────────────────
Route::get('/',          [FrontendController::class, 'home'])->name('home');
Route::get('/posts/{slug}', [FrontendController::class, 'post'])->name('posts.show');
Route::get('/resume',    [FrontendController::class, 'resume'])->name('resume');

// Contact form & subscription – rate-limited to prevent abuse
Route::middleware('throttle:5,1')->group(function () {
    Route::post('/contact',   [ContactController::class, 'submit'])->name('contact.submit');
    Route::post('/subscribe', [ContactController::class, 'subscribe'])->name('subscribe');
});

// Email verification link for subscribers
Route::get('/subscribe/verify/{token}', [ContactController::class, 'verify'])->name('subscribe.verify');

// ─────────────────────────────────────────────────────────────────────────────
// Public Chat API (guest widget – no auth required, identified by session UUID)
// ─────────────────────────────────────────────────────────────────────────────
Route::prefix('chat')->name('chat.')->middleware('throttle:60,1')->group(function () {
    Route::post('/start',                   [ChatController::class, 'start'])->name('start');
    Route::post('/{sessionId}/send',        [ChatController::class, 'sendMessage'])->name('send');
    Route::post('/{sessionId}/read',        [ChatController::class, 'markRead'])->name('read');
});

// ─────────────────────────────────────────────────────────────────────────────
// Admin Routes – protected by auth + admin middleware
// ─────────────────────────────────────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',  [AdminController::class, 'index'])->name('dashboard');
    Route::resource('projects',   ProjectController::class);
    Route::resource('skills',     SkillController::class);
    Route::resource('experience', ExperienceController::class);
    Route::resource('posts',      PostController::class);
    Route::resource('subscribers', SubscriberController::class);
    Route::resource('content',    PageContentController::class);
    Route::resource('messages',   \App\Http\Controllers\Admin\MessageController::class)->only(['index', 'destroy']);

    // ── Chat management ──────────────────────────────────────────────────────
    Route::prefix('chat')->name('chat.')->group(function () {
        Route::get('/',                         [\App\Http\Controllers\Admin\ChatController::class, 'index'])->name('index');
        Route::get('/{sessionId}',              [\App\Http\Controllers\Admin\ChatController::class, 'show'])->name('show');
        Route::post('/{sessionId}/reply',       [\App\Http\Controllers\Admin\ChatController::class, 'reply'])->name('reply');
        Route::post('/{sessionId}/close',       [\App\Http\Controllers\Admin\ChatController::class, 'close'])->name('close');
    });
});

// ─────────────────────────────────────────────────────────────────────────────
// Breeze auth routes (login/logout only – registration is disabled)
// ─────────────────────────────────────────────────────────────────────────────
require __DIR__.'/auth.php';
