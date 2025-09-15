<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'user_name',
        'email',
        'rating',
        'message'
    ];

    protected $casts = [
        'rating' => 'integer'
    ];
    
    /**
     * Get the user that owns the feedback.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
