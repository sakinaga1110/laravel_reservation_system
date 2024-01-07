<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Charge;
use Carbon\Carbon;

class ChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 今月の初日と最終日を取得
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // 今月の各日に対してループ
        for ($date = $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
            Charge::create([
                'room_id' => 1, // 適切な部屋IDを設定
                'date' => $date->toDateString(),
                'plan_id' => 1, // 適切なプランIDを設定
                'charge' => '5000' // 金額
            ]);
        }
    }
}


