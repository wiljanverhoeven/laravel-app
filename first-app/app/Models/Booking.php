<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bus_route_id',
        'booking_reference',
        'number_of_seats',
        'total_price',
        'status',
        'payment_status',
    ];


    protected $casts = [
        'total_price' => 'decimal:2',
    ];

   
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function busRoute()
    {
        return $this->belongsTo(BusRoute::class);
    }

    
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    
    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }

    
    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }



    
    public static function generateBookingReference()
    {
        $reference = strtoupper(substr(uniqid(), -6)) . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4));
        
       
        while (self::where('booking_reference', $reference)->exists()) {
            $reference = strtoupper(substr(uniqid(), -6)) . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4));
        }
        
        return $reference;
    }
}

