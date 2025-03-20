<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnBusRoute extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'festival_id',
        'departure_location',
        'arrival_location',
        'arrival_address',
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

   
    public function returnBookings()
    {
        return $this->hasMany(ReturnBooking::class);
    }

    
    public function remainingSeats()
    {
        $bookedSeats = $this->returnBookings()->sum('number_of_seats');
        return $this->capacity - $bookedSeats;
    }
}
