<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing'); // Halaman Home
})->name('home');

Route::get('/booking', function () {
    return view('booking'); // Halaman Booking
})->name('booking');

Route::get('/shop', function () {
    return view('shop'); // Halaman Shop
})->name('shop');

Route::get('/contact', function () {
    return view('contact'); // Halaman Contact
})->name('contact');

Route::get('/register', function () {
    return view('register'); // Halaman register
})->name('register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
