<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reservations')->insert([
            'user_id' => 21,
            'shop_id' => 1,
            'reservation_date' => now()->addDays(1)->toDateString(),
            'reservation_time' => '18:00:00',
            'number_of_people' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('reservations')->insert([
            'user_id' => 21,
            'shop_id' => 2,
            'reservation_date' => now()->addDays(2)->toDateString(),
            'reservation_time' => '20:00:00',
            'number_of_people' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('reservations')->insert([
            'user_id' => 21,
            'shop_id' => 3,
            'reservation_date' => now()->addDays(3)->toDateString(),
            'reservation_time' => '11:00:00',
            'number_of_people' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('reservations')->insert([
            'user_id' => 21,
            'shop_id' => 4,
            'reservation_date' => now()->addDays(4)->toDateString(),
            'reservation_time' => '17:00:00',
            'number_of_people' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('reservations')->insert([
            'user_id' => 21,
            'shop_id' => 5,
            'reservation_date' => now()->addDays(5)->toDateString(),
            'reservation_time' => '21:00:00',
            'number_of_people' => 8,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


    }
}
