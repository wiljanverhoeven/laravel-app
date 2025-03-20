<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnBooking extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'booking_id',
        'return_bus_route_id',
        'number_of_seats',
        'total_price',
    ];

    
    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    
    public function returnBusRoute()
    {
        return $this->belongsTo(ReturnBusRoute::class);
    }
}
