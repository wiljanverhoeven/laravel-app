<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use Notifiable, HasRoles;

   
    protected $fillable = [
        'name', 'email', 'password', 'points', 'total_bus_bookings', 'last_bus_booking_date', 'loyalty_tier'
    ];

   
    public function addPoints(int $pointsToAdd)
    {
        $this->points += $pointsToAdd;
        $this->updateLoyaltyTier();
        $this->save();
    }

   
    public function deductPoints(int $pointsToDeduct)
    {
        if ($this->points >= $pointsToDeduct) {
            $this->points -= $pointsToDeduct;
            $this->updateLoyaltyTier();
            $this->save();
            return true;
        }
        return false;
    }

  
    public function recordBusBooking(int $bookingPoints = 10)
    {
        $this->total_bus_bookings++;
        $this->last_bus_booking_date = now();
        $this->addPoints($bookingPoints);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }



}