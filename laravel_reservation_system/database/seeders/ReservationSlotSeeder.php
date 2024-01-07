<?php

namespace Database\Seeders;

use App\Models\ReservationSlot;
use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ReservationSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 既存の部屋を取得するか、または特定の部屋IDを設定します。
        $rooms = Room::all();

        foreach ($rooms as $room) {
            for ($i = 0; $i < 30; $i++) {
                // 今日から30日間の日付を生成
                $date = Carbon::today()->addDays($i);

                // 予約枠を作成して保存
                ReservationSlot::create([
                    'room_id' => $room->id,
                    'date' => $date,
                    'count' => rand(1, 10),  // 1から10の間でランダムな数
                ]);
            }
        }
    }
}
