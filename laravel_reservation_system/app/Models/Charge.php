<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'id');
    }
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id', 'id');
    }
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
    public function chargeParent()
    {
        return $this->belongsTo(ChargeParent::class, 'charge_parent_id', 'id');
    }
    
}
