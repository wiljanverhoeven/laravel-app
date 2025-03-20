<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'booking_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'special_requirements',
    ];

    
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}