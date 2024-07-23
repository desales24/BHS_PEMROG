<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timetamp = \Carbon\Carbon::now()->toDateTimeString();

        DB::table('users')->insert([
            'username' => 'desales',
            'password' => 'desales1',
            'created_at' => $timetamp,
            'updated_at' => $timetamp
        ]);
    }
}
