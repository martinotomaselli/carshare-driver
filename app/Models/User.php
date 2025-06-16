<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Billable;
    use HasApiTokens,HasFactory,Notifiable;

    protected $fillable=['name','email','password','is_admin','is_reviewer'];
    protected $hidden=['password','remember_token'];

    protected $casts=[
        'email_verified_at'=>'datetime',
        'is_admin'=>'boolean',
        'is_reviewer'=>'boolean',
    ];

    public function bookings(){return $this->hasMany(Booking::class);}    
}