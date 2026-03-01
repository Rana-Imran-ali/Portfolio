<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ContactController;
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
Route::get('/about',     [FrontendController::class, 'about'])->name('about');
Route::get('/skills',    [FrontendController::class, 'skills'])->name('skills');
Route::get('/projects',  [FrontendController::class, 'projects'])->name('projects');
Route::get('/experience',[FrontendController::class, 'experience'])->name('experience');
Route::get('/posts',     [FrontendController::class, 'posts'])->name('posts');
Route::get('/posts/{slug}', [FrontendController::class, 'post'])->name('posts.show');
Route::get('/contact',   [FrontendController::class, 'contact'])->name('contact');
Route::get('/resume',    [FrontendController::class, 'resume'])->name('resume');

// Contact form & subscription – rate-limited to prevent abuse
Route::middleware('throttle:5,1')->group(function () {
    Route::post('/contact',   [ContactController::class, 'submit'])->name('contact.submit');
    Route::post('/subscribe', [ContactController::class, 'subscribe'])->name('subscribe');
});

// Email verification link for subscribers
Route::get('/subscribe/verify/{token}', [ContactController::class, 'verify'])->name('subscribe.verify');

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
});

// ─────────────────────────────────────────────────────────────────────────────
// Breeze auth routes (login/logout only – registration is disabled)
// ─────────────────────────────────────────────────────────────────────────────
require __DIR__.'/auth.php';
