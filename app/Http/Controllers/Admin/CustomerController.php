<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    /**
     * List customers (members with role=member) with optional filters and pagination.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Member::query()->where('role', 'member')->withCount('bookings');

        // Optional search by name/email/phone/address
        if ($search = trim((string) $request->get('q', ''))) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        $perPage = (int) $request->get('per_page', 10);
        $perPage = $perPage > 0 ? $perPage : 10;

        $customers = $query->orderByDesc('created_at')->paginate($perPage);

        return response()->json($customers);
    }

    /**
     * Show a single customer by ID.
     */
    public function show(Member $member): JsonResponse
    {
        if ($member->role !== 'member') {
            return response()->json(['message' => 'Not found'], 404);
        }
        $member->loadCount('bookings');
        return response()->json($member);
    }

    /**
     * Create a new customer (member with role=member).
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members,email',
            'phone' => 'required|string|max:20|unique:members,phone',
            'address' => 'nullable|string|max:255',
            'status' => 'nullable|in:active,inactive',
        ]);

        $member = Member::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'] ?? null,
            'role' => 'member',
            'status' => $data['status'] ?? 'active',
        ]);

        return response()->json($member, 201);
    }

    /**
     * Update an existing customer.
     */
    public function update(Request $request, Member $member): JsonResponse
    {
        if ($member->role !== 'member') {
            return response()->json(['message' => 'Not found'], 404);
        }

        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:members,email,' . $member->id,
            'phone' => 'sometimes|required|string|max:20|unique:members,phone,' . $member->id,
            'address' => 'nullable|string|max:255',
            'status' => 'nullable|in:active,inactive',
        ]);

        $member->fill($data);
        $member->save();

        return response()->json($member);
    }

    /**
     * Delete a customer.
     */
    public function destroy(Member $member): JsonResponse
    {
        if ($member->role !== 'member') {
            return response()->json(['message' => 'Not found'], 404);
        }

        $member->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
