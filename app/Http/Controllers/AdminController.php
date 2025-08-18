<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function productmanagement()
    {
        return view('admin.productmanagement');
    }

    public function customer()
    {
        return view('admin.customer');
    }

    public function managebooking()
    {
        return view('admin.managebooking');
    }

    public function schedule()
    {
        return view('admin.schedule');
    }

    public function testimonial()
    {
        return view('admin.testimonial');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
