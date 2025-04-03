<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusRoute extends Model
{
    use HasFactory;

    
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

   
    protected $casts = [
        'departure_date' => 'datetime',
        'arrival_date' => 'datetime',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    
    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }

    
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


    
    public function remainingSeats()
    {
        $bookedSeats = $this->bookings()->sum('number_of_seats');
        return $this->capacity - $bookedSeats;
    }
}
