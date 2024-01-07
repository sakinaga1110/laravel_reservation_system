<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use App\Models\Plan;
use App\Models\ReservationSlot;
use App\Models\Room;
use Illuminate\Http\Request;


class ReservationSlotController extends Controller
{
    public function index()
    {

        return view('reservation_system.reservation_slot.index', [
        ]);

    }
    public function calendar()
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
                'url' => route('reservation_slot.show', ['reservation_slot' => $reservation_slot]),
            ];
        }

        return response()->json($events);
    }




    public function create()
    {
        $plans = Plan::all();
        $rooms = Room::all();
        return view('reservation_system.reservation_slot.create', [
            'rooms' => $rooms,
            'plans' => $plans,
        ]);
    }

    public function store(Request $request,Charge $charge)
    {
        // フォームから送信されたデータを受け取ります
        $room_id = $request->input('room_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $count = $request->input('count');
        // $plan_id = $request->input('plan_id');
        // $charge_item = $request->input('charge');
        // 開始日から終了日までの各日付に対して処理を行います
        $current_date = new \DateTime($start_date);
        $end_date = new \DateTime($end_date);

        while ($current_date <= $end_date) {
            // 既存の予約枠を日付と部屋タイプで検索
            $existingSlot = ReservationSlot::where('date', $current_date->format('Y-m-d'))
                ->where('room_id', $room_id)
                ->first();

            if ($existingSlot) {
                // 既存の予約枠が存在する場合、カウントを増やします
                $existingSlot->count += $count;
                $existingSlot->save();
                // $charge->room_id=$room_id;
                // $charge->date=$current_date->format('Y-m-d');
                // $charge->plan_id=$plan_id;
                // $charge->charge=$charge_item;
                // $charge->save();
            } else {
                // 既存の予約枠が存在しない場合、新しい予約枠を作成します
                $reservationSlot = new ReservationSlot();
                $reservationSlot->room_id = $room_id;
                $reservationSlot->date = $current_date->format('Y-m-d');
                $reservationSlot->count = $count;
                $reservationSlot->save();

                // $charge->room_id=$room_id;
                // $charge->date=$current_date->format('Y-m-d');
                // $charge->plan_id=$plan_id;
                // $charge->charge=$charge_item;
                // $charge->save();
            }
            
            // 日付を1日進める
            $current_date->add(new \DateInterval('P1D'));
        }



        // リダイレクトなどの適切なレスポンスを返す
        return redirect()->route('reservation_slot.create')->with('status', '予約枠を作成しました');
    }



    public function getAvailability(Request $request)
    {
        // フォームから送信されたデータを受け取ります
        $room_id = $request->input('room_id');
        $start_date = new \DateTime($request->input('start_date'));
        $end_date = new \DateTime($request->input('end_date'));


        // 利用可能な予約枠のカウンターを初期化
        $maxCount = 0;
        $number_of_rooms = Room::where('id', $room_id)->first()->number_of_rooms;
        // ループを使用して日付の範囲内の各日予約枠を検索
        while ($start_date <= $end_date) {
            // 予約枠を検索
            $reservationSlots = ReservationSlot::where('room_id', $room_id)
                ->whereDate('date', $start_date->format('Y-m-d'))
                ->sum('count'); // sum()を使用して各日の枠数を合計

            // 最大の予約枠数を更新
            if ($reservationSlots > $maxCount) {
                $maxCount = $reservationSlots;
            }
            // 日付を1日進める
            $start_date->add(new \DateInterval('P1D'));
        }
        $availableCount = $number_of_rooms - $maxCount;
        // 結果をJSONレスポンスとして返す
        return response()->json(['available_count' => $availableCount]);
    }

    public function show($id)
    {

        $reservation_slot = ReservationSlot::find($id);
        $room = Room::find($reservation_slot->room_id);
        return view('reservation_system.reservation_slot.show', ['id' => $id, 'reservation_slot' => $reservation_slot, 'room' => $room]);

    }

    public function update(Request $request, ReservationSlot $reservationSlot)
    {
        if ($reservationSlot->count > 0) {
            // カウントが1以上の場合、1つ減らす
            $reservationSlot->count -= 1;
            $reservationSlot->save();

            return redirect()->route('reservation_slot.show', ['reservation_slot' => $reservationSlot])
                ->with('success', 'カウントを1つ減らしました。');
        }

        // カウントが0以下の場合、何もしない
        return redirect()->route('reservation_slot.show', ['reservation_slot' => $reservationSlot])
            ->with('error', 'カウントを減らすことができません。');
    }

    public function destroy($id)
    {
        //
    }
}