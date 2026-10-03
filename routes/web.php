<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\WishController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\GalleryController;

// Frontend Routes
Route::get('/', function () {
    return redirect('/undangan/tamu');
});
Route::get('/undangan/{slug}', [FrontendController::class, 'show'])->name('frontend.show');
Route::post('/undangan/{slug}/wish', [FrontendController::class, 'storeWish'])->name('frontend.wish.store');
Route::post('/undangan/{slug}/rsvp', [FrontendController::class, 'storeRsvp'])->name('frontend.rsvp.store');
Route::post('/undangan/{slug}/rsvp-wish', [FrontendController::class, 'storeRsvpWish'])->name('frontend.rsvp-wish.store');

// Admin Auth
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    
    Route::resource('guests', GuestController::class);
    
    Route::get('/wishes', [WishController::class, 'index'])->name('wishes.index');
    Route::delete('/wishes/{wish}', [WishController::class, 'destroy'])->name('wishes.destroy');
    
    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::delete('/attendances/{attendance}', [AttendanceController::class, 'destroy'])->name('attendances.destroy');
    
    Route::resource('gallery', GalleryController::class)->only(['index', 'store', 'destroy']);
});
