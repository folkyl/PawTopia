<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Tampilkan form booking
     */
    public function create()
    {
        return view('booking');
    }

    /**
     * Simpan booking baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_type' => 'required|string|in:grooming,boarding,veterinary,training',
            'pet_name' => 'required|string|max:255',
            'pet_type' => 'required|string|in:dog,cat,bird,rabbit,other',
            'booking_date' => 'required|date|after:today',
            'booking_time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Hitung harga berdasarkan service type
        $prices = [
            'grooming' => 150000,
            'boarding' => 200000,
            'veterinary' => 300000,
            'training' => 250000
        ];

        $booking = Booking::create([
            'member_id' => Auth::guard('member')->user()->id,
            'service_type' => $request->service_type,
            'pet_name' => $request->pet_name,
            'pet_type' => $request->pet_type,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'notes' => $request->notes,
            'status' => 'pending',
            'total_price' => $prices[$request->service_type]
        ]);

        return redirect()->route('booking.success', $booking->id)
                        ->with('success', 'Booking berhasil dibuat! Silakan tunggu konfirmasi dari admin.');
    }

    /**
     * Tampilkan detail booking
     */
    public function show(Booking $booking)
    {
        // Pastikan user hanya bisa lihat booking miliknya sendiri
        if (Auth::guard('member')->user()->id !== $booking->member_id) {
            abort(403, 'Unauthorized access');
        }

        return view('booking.show', compact('booking'));
    }

    /**
     * Tampilkan halaman sukses booking
     */
    public function success(Booking $booking)
    {
        return view('booking.success', compact('booking'));
    }

    /**
     * Tampilkan history booking user
     */
    public function history()
    {
        $bookings = Booking::where('member_id', Auth::guard('member')->user()->id)
                          ->latest()
                          ->paginate(10);

        return view('history', compact('bookings'));
    }

    /**
     * Cancel booking
     */
    public function cancel(Booking $booking)
    {
        // Pastikan user hanya bisa cancel booking miliknya sendiri
        if (Auth::guard('member')->user()->id !== $booking->member_id) {
            abort(403, 'Unauthorized access');
        }

        // Hanya bisa cancel jika status masih pending
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking tidak bisa dibatalkan karena sudah dikonfirmasi.');
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking berhasil dibatalkan.');
    }

    // ========== ADMIN METHODS ==========

    /**
     * Tampilkan semua booking untuk admin
     */
    public function adminIndex()
    {
        $bookings = Booking::with('member')
                          ->latest()
                          ->paginate(15);

        return view('admin.managebooking', compact('bookings'));
    }

    /**
     * Update status booking (admin only)
     */
    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $booking->update(['status' => $request->status]);

        return back()->with('success', 'Status booking berhasil diupdate.');
    }

    /**
     * Hapus booking (admin only)
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return back()->with('success', 'Booking berhasil dihapus.');
    }
}
