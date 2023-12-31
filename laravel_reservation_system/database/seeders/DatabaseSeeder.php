<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoomSeeder::class);
        $this->call(PlanSeeder::class);
        $this->call(ReservationSlotSeeder::class);
        $this->call(ChargeSeeder::class);

    }
}

