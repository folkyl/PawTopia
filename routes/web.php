<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController; 
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CustomerController;

// Guest Pages
Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/booking', [BookingController::class, 'create'])->name('booking');
Route::get('/shop', [UserController::class, 'shop'])->name('shop');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::get('/calendar', [UserController::class, 'calendar'])->name('calendar');

// Booking Routes (Member only)
Route::middleware('auth:member')->group(function () {
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{booking}', [BookingController::class, 'show'])->name('booking.show');
    Route::get('/booking/{booking}/success', [BookingController::class, 'success'])->name('booking.success');
    Route::post('/booking/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
    Route::get('/history', [BookingController::class, 'history'])->name('history');
});

// Feedback Routes (member only)
Route::post('/feedback', [FeedbackController::class, 'store'])
    ->middleware('auth:member')
    ->name('feedback.store');

// Member Auth
Route::get('/register', function () {
    return view('register'); // tampilkan form
})->name('register.page');
Route::post('/register', [MemberController::class, 'register'])->name('register');

Route::get('/login', function () {
    return view('register'); // tampilkan form
})->name('register.page');
Route::post('/login', [MemberController::class, 'login'])->name('login');

Route::post('/logout', [MemberController::class, 'logout'])->name('logout');

// Admin Auth Routes - menggunakan member login dengan role admin
Route::post('/admin/logout', [MemberController::class, 'logout'])->name('admin.logout');

Route::get('/profile', [UserController::class, 'profile'])
    ->middleware('auth:member') // ✅ hanya bisa diakses kalau login
    ->name('profile');
    Route::get('/check-auth', function() {
        return response()->json([
            'authenticated' => auth()->check()
        ]);
    })->name('check.auth');
// Admin Pages
Route::middleware('role:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/productmanagement', [AdminController::class, 'productmanagement']);
    Route::get('/admin/customer', [AdminController::class, 'customer']);
    Route::get('/admin/managebooking', [BookingController::class, 'adminIndex'])->name('admin.managebooking');
    // Admin Booking JSON APIs
    Route::get('/admin/bookings', [BookingController::class, 'adminList'])->name('admin.bookings.index');
    Route::post('/admin/bookings', [BookingController::class, 'adminStore'])->name('admin.bookings.store');
    Route::get('/admin/bookings/{booking}', [BookingController::class, 'adminShow'])->name('admin.bookings.show');
    Route::put('/admin/bookings/{booking}', [BookingController::class, 'adminUpdate'])->name('admin.bookings.update');
    Route::post('/admin/booking/{booking}/status', [BookingController::class, 'updateStatus'])->name('admin.booking.status');
    Route::delete('/admin/booking/{booking}', [BookingController::class, 'destroy'])->name('admin.booking.destroy');
    Route::get('/admin/schedule', [AdminController::class, 'schedule']);
    Route::get('/admin/testimonial', [AdminController::class, 'testimonial']);
    
    // Admin Feedback Routes
    Route::prefix('admin/feedback')->group(function () {
        Route::get('/', [FeedbackController::class, 'index'])->name('admin.feedback.index');
        Route::put('/{feedback}', [FeedbackController::class, 'update'])->name('admin.feedback.update');
        Route::delete('/{feedback}', [FeedbackController::class, 'destroy'])->name('admin.feedback.destroy');
    });
    
    // Admin Product Routes (JSON APIs)
    Route::prefix('admin/products')->name('admin.products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}', [ProductController::class, 'show'])->name('show');
        Route::put('/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });

    // Admin Customer Routes (JSON APIs) - manage members with role=member
    Route::prefix('admin/customers')->name('admin.customers.')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::post('/', [CustomerController::class, 'store'])->name('store');
        Route::get('/{member}', [CustomerController::class, 'show'])->name('show');
        Route::put('/{member}', [CustomerController::class, 'update'])->name('update');
        Route::delete('/{member}', [CustomerController::class, 'destroy'])->name('destroy');
    });

    Route::get('/admin/settings', [AdminController::class, 'settings']);
    Route::get('/admin/petfood', [AdminController::class, 'petfood'])->name('admin.petfood');
    Route::get('/admin/petsupplies', [AdminController::class, 'petsupplies'])->name('admin.petsupplies'); 
    Route::get('/admin/petvitamins', [AdminController::class, 'petvitamins'])->name('admin.petvitamins');
    Route::get('/admin/testimoni', [FeedbackController::class, 'testimonial'])->name('admin.testimoni');
});
