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

        return redirect()->route('admin.login'); // arahkan ke admin login page
    }

    // halaman dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // dst...
    public function productmanagement()
    {
        // Preload products from DB so the view can render immediately
        \App\Models\Product::query(); // ensure model is autoloaded
        $all = \App\Models\Product::orderByDesc('created_at')->get();

        $petFood = $all->filter(function ($p) {
            $c = strtolower(trim((string)$p->category));
            return $c === 'cat food' || $c === 'dog food' || str_contains($c, 'food');
        })->take(3);
        $supplies = $all->filter(function ($p) {
            $c = strtolower(trim((string)$p->category));
            return $c === 'supplies' || str_contains($c, 'suppl');
        })->take(3);
        $vitamins = $all->filter(function ($p) {
            $c = strtolower(trim((string)$p->category));
            return $c === 'vitamin' || str_contains($c, 'vitamin');
        })->take(3);

        return view('admin.productmanagement', compact('petFood', 'supplies', 'vitamins'));
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

    public function petfood()
    {
        $all = \App\Models\Product::orderByDesc('created_at')->get();
        $items = $all->filter(function ($p) {
            $c = strtolower(trim((string)$p->category));
            return $c === 'cat food' || $c === 'dog food' || str_contains($c, 'food');
        });
        return view('admin.petfood', ['items' => $items]);
    }

    public function petsupplies()
    {
        $all = \App\Models\Product::orderByDesc('created_at')->get();
        $items = $all->filter(function ($p) {
            $c = strtolower(trim((string)$p->category));
            return $c === 'supplies' || str_contains($c, 'suppl');
        });
        return view('admin.petsupplies', ['items' => $items]);
    }

    public function petvitamins()
    {
        $all = \App\Models\Product::orderByDesc('created_at')->get();
        $items = $all->filter(function ($p) {
            $c = strtolower(trim((string)$p->category));
            return $c === 'vitamin' || str_contains($c, 'vitamin');
        });
        return view('admin.petvitamins', ['items' => $items]);
    }
}
