<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name',
        'description',
        'location',
        'start_date',
        'end_date',
        'image_path',
        'is_active',
    ];

    
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
    ];


    
    
    public function busRoutes()
    {
        return $this->hasMany(BusRoute::class);
    }

    
    public function returnBusRoutes()
    {
        return $this->hasMany(ReturnBusRoute::class);
    }
}