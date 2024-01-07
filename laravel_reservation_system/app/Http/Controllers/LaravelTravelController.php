<?php

namespace App\Http\Controllers;

use App\Mail\InquiryCompleteMail;
use App\Mail\reservationCompleteMail;
use App\Models\Charge;
use App\Models\ChargeParent;
use App\Models\Image;
use App\Models\Inquiry;
use App\Models\Plan;
use App\Models\Reservation;
use App\Models\ReservationSlot;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;



class LaravelTravelController extends Controller
{
    public function top()
    {
        return view('hotel_laravel.top');
    }

    public function rooms()
    {
        return view('hotel_laravel.rooms');
    }

    public function plans()
    {
        $plans = Plan::with('images')->get();

        return view('hotel_laravel.plans', ['plans' => $plans]);
    }
    public function room_calender(Plan $plan)
    {
        return view('hotel_laravel.room_calender', ['plan' => $plan]);
    }
    public function calender(Plan $plan)
    {
        $charges = Charge::where('plan_id', $plan->id)->get();
        $dates = $charges->pluck('date')->all();

        $reservation_slots = ReservationSlot::whereIn('date', $dates)->where('count', '>', 0)->get();
        $room_id = [
            1 => 'ｼﾝｸﾞﾙ',
            2 => 'ﾀﾞﾌﾞﾙ',
            3 => 'ﾂｲﾝ',
            4 => 'ﾌｧﾐﾘｰ'
        ];

        $events = [];

        foreach ($reservation_slots as $reservation_slot) {
            $title = $room_id[$reservation_slot->room_id] . ' ' . $reservation_slot->count;
            $events[] = [
                'title' => $title,
                'date' => $reservation_slot->date,
                'url' => route('hotel_laravel.reservation_create', ['reservation_slot' => $reservation_slot, 'plan' => $plan]),
            ];
        }

        return response()->json($events);
    }
    public function reservation_create()
    {

        $reservation_slot = ReservationSlot::where('id', request('reservation_slot'))->where('count', '>', 0)->first();
        $plan = Plan::find(request('plan'));

        return view('hotel_laravel.reservation_create', ['reservation_slot' => $reservation_slot, 'plan' => $plan]);
    }
    public function getMatchingData(Request $request)
    {

        $lodgingDays = $request->input('lodgingDays');
        $date = $request->input('date');
        $room_id = $request->input('room_id');
        $plan_id = $request->input('plan_id');
        // 宿泊数に応じて、Carbonを使用して日数を加算し、日付の範囲を生成
        $startDate = Carbon::parse($date);
        $endDate = $startDate->copy()->addDays($lodgingDays - 1);
        $charges = Charge::where('room_id', $room_id)
            ->where('plan_id', $plan_id)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();
        // 料金の合計を計算する
        $totalCharge = $charges->sum('charge');

        return response()->json(['charges' => $charges, 'total' => $totalCharge]);
    }

    public function reservation_complete(Request $request, Reservation $reservation, ReservationSlot $reservation_slot, Charge $charge)
    {
             // 宿泊日数と開始日を取得
    $lodgingDays = $request->input('lodging_days');
    $startDate = Carbon::parse($request->input('date'));
    $endDate = $startDate->copy()->addDays($lodgingDays - 1);

    // 宿泊期間中に利用可能な予約枠の確認
    $availableSlots = ReservationSlot::where('room_id', $request->input('room_id'))
        ->whereBetween('date', [$startDate, $endDate])
        ->where('count', '>', 0) // 予約可能な枠が存在するかチェック
        ->count();

    if ($availableSlots < $lodgingDays) {
        // 利用可能な予約枠が足りない場合はエラーを返す
        return redirect()->back()->with('error', '選択した日程で利用可能な予約枠がありません。');
    }

        // 予約データを取得
        $reservation->kana_last_name = $request->input('kana_last_name');
        $reservation->kana_first_name = $request->input('kana_first_name');
        $reservation->phone_num = $request->input('phone_num');
        $reservation->email = $request->input('email');
        $reservation->post_code = $request->input('post_code');
        $reservation->prefecture = $request->input('prefecture');
        $reservation->city = $request->input('city');
        $reservation->building = $request->input('building');
        $reservation->message = $request->input('message');
        $reservation->save();

        // 予約データが保存された後にreservation_idを取得
        $reservation_id = $reservation->id;
        // dd($reservation_id);

        // 宿泊日数を整数として取得
        $lodgingDays = $request->input('lodging_days');
        // dd($lodgingDays);
        // 開始日と終了日を日付オブジェクトとして計算
        $startDate = Carbon::parse($request->input('date'));
        $endDate = $startDate->copy()->addDays($lodgingDays - 1);
        // chargeテーブルのデータを取得
        $charges = $charge->where('room_id', $request->input('room_id'))
            ->where('plan_id', $request->input('plan_id'))
            ->whereBetween('date', [$startDate, $endDate])
            ->get();
        $charge_parents = new ChargeParent();
        foreach ($charges as $charge) {
            $charge_parent = $charge_parents->create([
                'reservation_id' => $reservation_id,
                'charge_id' => $charge->id,
            ]);
        }

        // 予約枠を減らす
        $reservation_slots = $reservation_slot->where('room_id', $request->input('room_id'))
            ->whereBetween('date', [$startDate, $endDate])
            ->get();
        // 各$reservation_slotモデルのcountを減らして保存
        foreach ($reservation_slots as $slot) {
            $slot->count -= 1;
            $slot->update();
        }

        $name = $reservation->kana_first_name . ' ' . $reservation->kana_last_name;
        $email = $reservation->email;
        $date = $request->input('date');
        Mail::to($email)->send(new reservationCompleteMail($name, $date));

        return redirect()->route('hotel_laravel.top')->with('success', '予約が完了しました');
    }




    public function reservation_store(Request $request)
    {
        // リクエストデータを取得し保存
        $reservation = new Reservation(); // Reservationモデルのインスタンスを作成
        $reservation->kana_last_name = $request->input('kana_last_name');
        $reservation->kana_first_name = $request->input('kana_first_name');
        $reservation->phone_num = $request->input('phone_num');
        $reservation->email = $request->input('email');
        $reservation->post_code = $request->input('post_code');
        $reservation->prefecture = $request->input('prefecture');
        $reservation->city = $request->input('city');
        $reservation->building = $request->input('building');
        $reservation->message = $request->input('message');
        $reservation->total = $request->input('');
        $reservation->save(); // 保存

        $name = $reservation->kana_first_name . ' ' . $reservation->kana_last_name;
        $email = $reservation->email;
        Mail::to($email)->send(new InquiryCompleteMail($name, $inquiry_content));

        // フラッシュメッセージを設定
        $successMessage = "お問い合わせいただきありがとうございます。当ホテルからお客様のお問い合わせに対する返信メールが届くまで、暫くお待ちください。お急ぎでしたらこちらにお電話にてご連絡ください。（TEL：000-0000-0000）.
        ";
        Session::flash('success', $successMessage);

        // TOPページにリダイレクト
        return redirect()->route('hotel_laravel.top');
    }





    public function inquiries()
    {
        return view('hotel_laravel.inquiries');
    }

    public function access()
    {
        return view('hotel_laravel.access');
    }
    // ここまでは各ページにビューを返す処理

    public function inquiries_complete(Request $request)
    {
        // リクエストデータを取得
        $requestData = $request->all();

        // データベースに保存するためにモデルを作成し、プロパティにデータを設定
        $inquiry = new Inquiry();
        $inquiry->name = $requestData['name'];
        $inquiry->email = $requestData['mail'];
        $inquiry->inquiry_content = $requestData['inquiry_content'];
        $inquiry->status = 'not_started';

        // データベースに保存
        $inquiry->save();

        $name = $inquiry->name;
        $email = $inquiry->email;
        $inquiry_content = $inquiry->inquiry_content;
        Mail::to($email)->send(new InquiryCompleteMail($name, $inquiry_content));

        // フラッシュメッセージを設定
        $successMessage = "お問い合わせいただきありがとうございます。当ホテルからお客様のお問い合わせに対する返信メールが届くまで、暫くお待ちください。お急ぎでしたらこちらにお電話にてご連絡ください。（TEL：000-0000-0000）.
        ";
        Session::flash('success', $successMessage);

        // TOPページにリダイレクト
        return redirect()->route('hotel_laravel.top');

    }
}