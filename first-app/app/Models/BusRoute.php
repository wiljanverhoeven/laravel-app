<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusRoute extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'festival_id',
        'departure_location',
        'departure_address',
        'departure_coordinates',
        'departure_date',
        'arrival_date',
        'capacity',
        'price',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'departure_date' => 'datetime',
        'arrival_date' => 'datetime',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get the festival that the bus route is for.
     */
    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }

    /**
     * Get all bookings for this bus route.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Calculate the remaining seats available.
     */
    public function remainingSeats()
    {
        $bookedSeats = $this->bookings()->sum('number_of_seats');
        return $this->capacity - $bookedSeats;
    }
}
