<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = DB::table('users')->insertGetId([
            'name' => 'Admin Proskill',
            'email' => 'admin@proskill.sch.id',
            'status' => '1',
            'password' => Hash::make('123456'),
            'last_login' => Carbon::now(),
        ]);

        DB::table('user_role')->insert([
            'user_id' => $userId,
            'role_id' => 1,
        ]);

        DB::table('user_profile')->insert([
            'user_id' => $userId,
            'role_id' => 1,
        ]);
    }
}
