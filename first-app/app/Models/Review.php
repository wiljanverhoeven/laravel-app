<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'booking_id',
        'rating',
        'comment',
    ];

    /**
     * Get the user who left the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the booking that this review is for.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}