<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'rating',
        'message',
        'user_name',
        'email',
        'user_id'
    ];

    protected $casts = [
        'rating' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    
    /**
     * Scope a query to only include popular feedbacks.
     */
    public function scopePopular($query)
    {
        return $query->where('rating', '>=', 4);
    }
    
    /**
     * Scope a query to only include recent feedbacks.
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }
}
