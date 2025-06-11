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

}
