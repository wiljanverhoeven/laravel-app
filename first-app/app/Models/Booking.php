<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'bus_route_id',
        'booking_reference',
        'number_of_seats',
        'total_price',
        'status',
        'payment_status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    /**
     * Get the user who made the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the bus route for this booking.
     */
    public function busRoute()
    {
        return $this->belongsTo(BusRoute::class);
    }

    /**
     * Get the return booking associated with this booking.
     */
    public function returnBooking()
    {
        return $this->hasOne(ReturnBooking::class);
    }

    /**
     * Get the payment for this booking.
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Get the passengers associated with this booking.
     */
    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }

    /**
     * Get the review for this booking.
     */
    public function review()
    {
        return $this->hasOne(Review::class);
    }

    /**
     * Generate a unique booking reference.
     */
    public static function generateBookingReference()
    {
        $reference = strtoupper(substr(uniqid(), -6)) . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4));
        
        // Make sure it's unique
        while (self::where('booking_reference', $reference)->exists()) {
            $reference = strtoupper(substr(uniqid(), -6)) . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4));
        }
        
        return $reference;
    }
}

