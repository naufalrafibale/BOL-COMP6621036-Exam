<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillalbe = [
        'price',
        'booked_nights',
        'booked_start_date',
        'booked_end_date',
        'customer_id',
        'room_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
