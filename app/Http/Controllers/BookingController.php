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

        // Jika request dari AJAX/JSON, kembalikan JSON supaya UI bisa menampilkan modal sukses tanpa redirect
        if ($request->expectsJson() || $request->ajax()) {
            $booking->load('member');
            return response()->json([
                'message' => 'Booking berhasil dibuat! Silakan tunggu konfirmasi dari admin.',
                'booking' => $booking,
            ], 201);
        }

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
     * API: Create booking by admin from Manage Booking page.
     */
    public function adminStore(Request $request)
    {
        $validated = $request->validate([
            'customer' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email',
            'pet' => 'required|string|max:255',
            'petType' => 'required|string|max:50',
            'checkin' => 'required|date',
            'status' => 'required|in:pending,confirmed,checked-in,completed,cancelled,on-pickup',
            'service' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
        ]);

        // Find or create member by phone (primary) or email
        $member = Member::query()
            ->when($validated['phone'] ?? null, fn($q) => $q->orWhere('phone', $validated['phone']))
            ->when($validated['email'] ?? null, fn($q) => $q->orWhere('email', $validated['email']))
            ->first();

        if (!$member) {
            $member = Member::create([
                'name' => $validated['customer'],
                'phone' => $validated['phone'],
                'email' => $validated['email'] ?? null,
                'role' => 'customer',
            ]);
        } else {
            // Update member basic info if changed
            $member->fill([
                'name' => $validated['customer'],
                'phone' => $validated['phone'],
            ]);
            if (!empty($validated['email'])) {
                $member->email = $validated['email'];
            }
            $member->save();
        }

        // Build notes to include delivery/service info if provided
        $notes = $request->input('notes');
        if ($validated['service'] ?? null) {
            $notes = trim(((string) $notes) . (empty($notes) ? '' : "\n") . 'Service: ' . $validated['service']);
        }

        // Create booking (map checkin -> booking_date, default booking_time)
        $booking = Booking::create([
            'member_id' => $member->id,
            // Treat all admin-created entries here as boarding by default
            'service_type' => 'boarding',
            'pet_name' => $validated['pet'],
            'pet_type' => strtolower($validated['petType']),
            'booking_date' => $validated['checkin'],
            'booking_time' => '09:00:00',
            'notes' => $notes,
            'status' => $validated['status'],
            'total_price' => $validated['price'],
        ]);

        $booking->load('member');

        return response()->json([
            'message' => 'Booking created successfully',
            'booking' => $booking,
        ], 201);
    }

    /**
     * API: List bookings untuk admin (JSON) dengan filter & pagination.
     */
    public function adminList(Request $request)
    {
        $query = Booking::with('member')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('q')) {
            $search = $request->string('q');
            $query->where(function ($q) use ($search) {
                $q->where('pet_name', 'like', "%{$search}%")
                  ->orWhere('pet_type', 'like', "%{$search}%")
                  ->orWhere('service_type', 'like', "%{$search}%");
            });
        }

        $perPage = (int) $request->input('per_page', 10);
        $bookings = $query->paginate($perPage);

        return response()->json($bookings);
    }

    /**
     * API: Detail 1 booking untuk admin (JSON)
     */
    public function adminShow(Booking $booking)
    {
        $booking->load('member');
        return response()->json($booking);
    }

    /**
     * API: Update booking by admin
     */
    public function adminUpdate(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'customer' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email',
            'pet' => 'required|string|max:255',
            'petType' => 'required|string|max:50',
            'checkin' => 'required|date',
            'status' => 'required|in:pending,confirmed,checked-in,completed,cancelled,on-pickup',
            'service' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
        ]);

        // Update linked member (by id)
        $booking->load('member');
        $member = $booking->member;
        if ($member) {
            $member->name = $validated['customer'];
            $member->phone = $validated['phone'];
            if (!empty($validated['email'])) {
                $member->email = $validated['email'];
            }
            $member->save();
        }

        $notes = $request->input('notes');
        if ($validated['service'] ?? null) {
            $notes = trim(((string) $notes) . (empty($notes) ? '' : "\n") . 'Service: ' . $validated['service']);
        }

        $booking->update([
            'pet_name' => $validated['pet'],
            'pet_type' => strtolower($validated['petType']),
            'booking_date' => $validated['checkin'],
            'notes' => $notes,
            'status' => $validated['status'],
            'total_price' => $validated['price'],
        ]);

        $booking->load('member');

        return response()->json([
            'message' => 'Booking updated successfully',
            'booking' => $booking,
        ]);
    }

    /**
     * Update status booking (admin only)
     */
    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,checked-in,completed,cancelled,on-pickup'
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
