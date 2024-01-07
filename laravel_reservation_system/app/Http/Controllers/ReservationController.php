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

    public function show(Reservation $reservation)
    {
        // Get all ChargeParent models related to the Reservation
        $charge_parents = ChargeParent::where('reservation_id', $reservation->id)->get();
        
        // Initialize an array to hold all charge IDs
        $charge_ids = [];
        
        // Loop through each ChargeParent to gather charge IDs
        foreach ($charge_parents as $charge_parent) {
            $charge_ids[] = $charge_parent->charge_id;
        }
        
        // Retrieve all Charges that match the gathered charge IDs
        $charges = Charge::whereIn('id', $charge_ids)->get();
        
        // Calculate the total charge
        $total_charge = $charges->sum('charge');
        
        // Return the view with the necessary data
        return view('reservation_system.reservation.show', [
            'reservation' => $reservation,
            'charges' => $charges,
            'total_charge' => $total_charge
        ]);
    }
    

    public function edit($id)
    {
        return view('reservation_system.reservation.edit',$id);
    }

    public function update(Request $request, Reservation $reservation)
    {
       $reservation->memo = $request->input('memo');
         $reservation->save();
            return redirect()->route('reservation.show', ['reservation' => $reservation])->with('status', 'メモを更新しました');
    }

    public function destroy($id)
    {
        
    }
}
