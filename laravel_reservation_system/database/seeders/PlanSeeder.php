<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            // サンプルのプランデータを作成
            $plans = [
                [
                    'title' => 'スタンダードプラン',
                    'detail' => '快適な一泊を提供する基本的なプランです。'
                ],
                [
                    'title' => 'デラックスプラン',
                    'detail' => '高級感あふれる部屋での滞在をお楽しみください。'
                ],
                [
                    'title' => 'ファミリープラン',
                    'detail' => '家族連れに最適な広々としたお部屋を提供します。'
                ],
            ];
    
            foreach ($plans as $plan) {
                Plan::create($plan);
            }
        }
    }

