<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'user_type' => '',
            'firstname' => 'ali',
            'lastname' => 'ali',
            'code' => null,
            'email' => 'ali@email.com',
            'phone' => '0974125896',
            'password' => Hash::make('123456789'),
        ]);
        DB::table('users')->insert([
            'user_type' => 'admin',
            'firstname' => 'ahmad',
            'lastname' => 'ahmad',
            'code' => null,
            'email' => 'ahmad@email.com',
            'phone' => '0963258741',
            'password' => Hash::make('123456789'),
        ]);
    }
}
