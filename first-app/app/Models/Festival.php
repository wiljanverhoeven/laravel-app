<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'location',
        'start_date',
        'end_date',
        'image_path',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Get all bus routes to this festival.
     */
    public function busRoutes()
    {
        return $this->hasMany(BusRoute::class);
    }

    /**
     * Get all return bus routes from this festival.
     */
    public function returnBusRoutes()
    {
        return $this->hasMany(ReturnBusRoute::class);
    }
}