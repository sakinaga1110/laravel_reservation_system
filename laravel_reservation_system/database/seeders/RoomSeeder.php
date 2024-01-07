<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::create([
            'room_type' => 'single',
            'number_of_rooms' => '10',
        ]);
        Room::create([
            'room_type' => 'twin',
            'number_of_rooms' => '5',
        ]);
        Room::create([
            'room_type' => 'double',
            'number_of_rooms' => '5',
        ]);
        Room::create([
            'room_type' => 'family',
            'number_of_rooms' => '3',
        ]);
    }
}
