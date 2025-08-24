<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/booking', [UserController::class, 'booking'])->name('booking');
Route::get('/shop', [UserController::class, 'shop'])->name('shop');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/calendar', [UserController::class, 'calendar'])->name('calendar');


Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name ('admin.dashboard');
Route::get('/admin/productmanagement', [AdminController::class, 'productmanagement']);
Route::get('/admin/customer', [AdminController::class, 'customer']);
Route::get('/admin/managebooking', [AdminController::class, 'managebooking']);
Route::get('/admin/schedule', [AdminController::class, 'schedule']);
Route::get('/admin/testimonial', [AdminController::class, 'testimonial']);
Route::get('/admin/settings', [AdminController::class, 'settings']);
Route::get('/admin/petfood', [AdminController::class, 'petfood'])->name('admin.petfood');
Route::get('/admin/petsupplies', [AdminController::class, 'petfood'])->name('admin.petsupplies'); 
Route::get('/admin/petvitamins', [AdminController::class, 'petvitamins'])->name('admin.petvitamins');