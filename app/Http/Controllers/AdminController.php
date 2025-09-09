<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // method untuk proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // method logout admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); // arahkan ke login page
    }

    // halaman dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // dst...
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
