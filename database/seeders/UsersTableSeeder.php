<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Mateen',
                'last_name'=> 'Haider',
                'email' => 'mateen@gmail.com',
                'password' => Hash::make('mateen'),
            ],
            [
                'first_name' => 'Niaz',
                'last_name' => 'Iqbal',
                'email' => 'niaz@gmail.com',
                'password' => Hash::make('niaz'),
            ],
            [
                'first_name' => 'Fatima',
                'last_name' => 'Mujahid',
                'email' => 'fatima@gmail.com',
                'password' => Hash::make('fatima'),
            ],
            [
                'first_name' => 'Momena',
                'last_name' => 'Shahbaz',
                'email' => 'momena@gmail.com',
                'password' => Hash::make('momena'),
            ],
        ]);
    }
}
