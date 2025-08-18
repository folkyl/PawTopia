<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        return view('landing');
    }

    public function calendar()
    {
        return view('calendar');
    }

    public function shop()
    {
        return view('shop');
    }

    public function contact()
    {
        return view('contact');
    }

    public function register()
    {
        return view('register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function profile()
    {
        return view('profile');
    }

    public function booking()
    {
        return view('booking');
    }
}
