<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
    'brand',
    'model',
    'type',
    'seats',
    'price_per_hour',
    'description',
];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getAvailableBookings($date, $startTime, $endTime)
    {
        return $this->bookings()
            ->where('date', $date)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where('start_time', '>=', $endTime)
                      ->orWhere('end_time', '<=', $startTime);
            })
            ->get();
    }

}
