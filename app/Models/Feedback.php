<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'user_id',
        'user_name',
        'email',
        'rating',
        'message',
        'status',
        'replied_at',
        'reply_message'
    ];

    protected $casts = [
        'rating' => 'integer',
        'replied_at' => 'datetime',
    ];
    
    /**
     * Get the user that owns the feedback.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
