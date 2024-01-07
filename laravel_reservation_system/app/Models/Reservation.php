<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    public function chargeParent()
    {
        return $this->hasMany(ChargeParent::class);
    }
   

}
