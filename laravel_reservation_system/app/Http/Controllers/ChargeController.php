<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use App\Models\Plan;
use App\Models\ReservationSlot;
use App\Models\Room;
use Illuminate\Http\Request;

class ChargeController extends Controller
{

    public function index()
    {

        return view('reservation_system.charge.index');
    }


    public function create(Request $request)
    {
        $room_id = [
            1 => 'シングル',
            2 => 'ダブル',
            3 => 'ツイン',
            4 => 'ファミリー'
        ];

        $reservation_slot = ReservationSlot::find($request->input('reservation_slot'));
        $alreadySetCharges = Charge::where('room_id', $reservation_slot->room_id)
            ->where('date', $reservation_slot->date)
            ->get();
        $planIds = $alreadySetCharges->pluck('plan_id');
        $plans = Plan::whereNotIn('id', $planIds)->get();

        return view('reservation_system.charge.create', ['room_id' => $room_id, 'plans' => $plans, 'reservation_slot' => $reservation_slot,]);
    }


    public function store(Request $request)
    {
        $room_id = $request->input('room_id');
        $date = $request->input('date');
        $plan_id = $request->input('plan_id');
        $charge = $request->input('charge');

        $data = new Charge();
        $data->room_id = $room_id;
        $data->date = $date;
        $data->plan_id = $plan_id;
        $data->charge = $charge;
        $data->save();
        return redirect()->route('charge.index')->with('status', '料金を登録しました');
    }


    public function show($id)
    {
        return view('reservation_system.charge.show');
    }


    public function edit($reservation_slot)
    {
        $room_id = [
            1 => 'シングル',
            2 => 'ダブル',
            3 => 'ツイン',
            4 => 'ファミリー'
        ];

        $reservation_slot = ReservationSlot::find($reservation_slot);

        $charges = Charge::with('plan') // Eager load the plan relationship
            ->where('room_id', $reservation_slot->room_id)
            ->where('date', $reservation_slot->date)
            ->get();

        return view('reservation_system.charge.edit', ['room_id' => $room_id, 'charges' => $charges]);
    }



    public function destroy($reservation_slot)
    { 
        $reservation_slot=ReservationSlot::find($reservation_slot);
        $charges = Charge::where('room_id', $reservation_slot->room_id)
        ->where('date', $reservation_slot->date)
        ->delete();
        return redirect()->route('charge.index')->with('status', '料金設定を破棄しました。再登録してください。');
    }
    public function chargeCalendar()
    {
        $reservation_slots = ReservationSlot::all();
        $room_id = [
            1 => 'シングル',
            2 => 'ダブル',
            3 => 'ツイン',
            4 => 'ファミリー'
        ];

        $events = [];

        foreach ($reservation_slots as $reservation_slot) {
            $title = $room_id[$reservation_slot->room_id] . ' ' . $reservation_slot->count;
            $events[] = [
                'title' => $title,
                'date' => $reservation_slot->date,
                'url' => route('charge.create', ['reservation_slot' => $reservation_slot]),
            ];
        }

        return response()->json($events);
    }
    public function updateBulk(Request $request)
    {
        $request->validate([
            'plan_ids.*' => 'required|distinct',
        ]);

        // フォームから送信されたデータを取得
        $room_id = $request->input('room_id');
        $date = $request->input('date');
        $plan_ids = $request->input('plan_ids');
        $charges = $request->input('charges');

        // 既存のデータを削除
        Charge::where('room_id', $room_id)->where('date', $date)->delete();

        // フォームデータをループして新たにレコードを作成
        foreach (array_map(null, $plan_ids, $charges) as [$plan_id, $charge]) {
            $data = new Charge();
            $data->room_id = $room_id;
            $data->date = $date;
            $data->plan_id = $plan_id;
            $data->charge = $charge;
            $data->save();
        }

        return redirect()->route('charge.index')->with('status', '一括更新が完了しました');
    }






}
