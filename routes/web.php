<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController; // ✅ tambahin
use App\Http\Controllers\FeedbackController;

// Guest Pages
Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/booking', [UserController::class, 'booking'])->name('booking');
Route::get('/shop', [UserController::class, 'shop'])->name('shop');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::get('/calendar', [UserController::class, 'calendar'])->name('calendar');

// Booking History (User)
Route::get('/history', [UserController::class, 'history'])->name('history');

// Feedback Routes
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

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
    Route::get('/admin/managebooking', [AdminController::class, 'managebooking']);
    Route::get('/admin/schedule', [AdminController::class, 'schedule']);
    Route::get('/admin/testimonial', [AdminController::class, 'testimonial']);
    Route::get('/admin/feedback', [FeedbackController::class, 'index'])->name('admin.feedback');
    Route::put('/admin/feedback/{id}', [FeedbackController::class, 'update'])->name('admin.feedback.update');
    Route::delete('/admin/feedback/{id}', [FeedbackController::class, 'destroy'])->name('admin.feedback.destroy');
    Route::post('/admin/feedback/{id}/reply', [FeedbackController::class, 'reply'])->name('admin.feedback.reply');
    Route::get('/admin/settings', [AdminController::class, 'settings']);
    Route::get('/admin/petfood', [AdminController::class, 'petfood'])->name('admin.petfood');
    Route::get('/admin/petsupplies', [AdminController::class, 'petfood'])->name('admin.petsupplies'); 
    Route::get('/admin/petvitamins', [AdminController::class, 'petvitamins'])->name('admin.petvitamins');
    Route::get('/admin/testimoni', [AdminController::class, 'testimoni'])->name('admin.testimoni');
});

