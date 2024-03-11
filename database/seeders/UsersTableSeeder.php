<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'テスト 太郎',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        DB::table('users')->insert([
            'name' => 'テスト 次郎',
            'email' => 'user2@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        DB::table('users')->insert([
            'name' => 'テスト 三郎',
            'email' => 'user3@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        DB::table('users')->insert([
            'name' => '管理 太郎',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => '店舗太郎',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
        ]);
    }
}

