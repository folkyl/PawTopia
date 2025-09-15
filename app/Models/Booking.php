<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'service_type',
        'pet_name',
        'pet_type',
        'booking_date',
        'booking_time',
        'notes',
        'status',
        'total_price'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'booking_time' => 'datetime',
        'total_price' => 'decimal:2'
    ];

    // Relationship dengan Member
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // Scope untuk status booking
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}