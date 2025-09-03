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

    public function testimoni()
    {
        return view('admin.testimoni');
    }

    public function feedback() 
    {
        return view('admin.feedback');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function petfood()
    {
        return view('admin.petfood');
    }

    public function petsupplies()
    {
        return view('admin.petsupplies');
    }

    public function petvitamins()
    {
        return view('admin.petvitamins');
    }
}

