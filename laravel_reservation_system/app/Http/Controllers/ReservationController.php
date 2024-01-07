<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use App\Models\ChargeParent;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    
    public function index()
    {
        $reservations = Reservation::all();

        return view('reservation_system.reservation.index', ['reservations' => $reservations]);
    }

   
    public function create()
    {
        return view('reservation_system.reservation.create');
    }

    public function store(Request $request)
    {
       
    }

    public function show($id)
    {
        return view('reservation_system.reservation.show',$id);
    }

    public function edit($id)
    {
        return view('reservation_system.reservation.edit',$id);
    }

    public function update(Request $request, $id)
    {
       
    }

    public function destroy($id)
    {
        
    }
}
