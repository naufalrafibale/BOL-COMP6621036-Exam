<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'price_per_night',
        'available_rooms',
        'booked_rooms',
    ];

    public function transaction()
    {
        return $this->hasOne(Room::class);
    }
}
