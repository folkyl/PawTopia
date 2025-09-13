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

    // Booking History Page (User)
    public function history()
    {
        // TODO: Replace with real bookings fetched from DB for the authenticated user
        // Example expected structure:
        // $bookings = Booking::where('member_id', auth('member')->id())->latest()->get();
        $bookings = []; // placeholder

        if (empty($bookings)) {
            // If user has never made a booking, show the empty-state History page.
            // The page's button will route to booking if logged in, or to member page if not.
            return view('history2');
        }

        // If user has bookings, pass them to the history table view
        return view('history', [
            'bookings' => $bookings,
        ]);
    }
}
