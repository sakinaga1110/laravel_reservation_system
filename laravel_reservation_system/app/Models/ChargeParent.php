<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargeParent extends Model
{
    use HasFactory;
    protected $fillable = [
        'reservation_id',
        'charge_id',
    ];
    public function charge()
    {
        return $this->belongsTo(Charge::class, 'charge_id', 'id');
    }
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id', 'id');
    }

}
