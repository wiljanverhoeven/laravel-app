<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

   
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

  
    protected function updateLoyaltyTier()
    {
        if ($this->points < 100) {
            $this->loyalty_tier = 'bronze';
        } elseif ($this->points < 500) {
            $this->loyalty_tier = 'silver';
        } elseif ($this->points < 1000) {
            $this->loyalty_tier = 'gold';
        } else {
            $this->loyalty_tier = 'platinum';
        }
    }

    public function scopeLoyaltyTier($query, $tier)
    {
        return $query->where('loyalty_tier', $tier);
    }
}