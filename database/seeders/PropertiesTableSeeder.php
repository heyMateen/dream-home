<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch all user IDs for the 'owner_id' foreign key
        $ownerIds = DB::table('users')->pluck('id')->toArray();

        // Possible statuses for properties
        $statuses = ['available', 'sold'];

        // Generate 10 properties
        $properties = [];
        for ($i = 0; $i < 10; $i++) {
            $properties[] = [
                'owner_id' => $ownerIds[array_rand($ownerIds)],
                'title' => 'Property ' . ($i + 1),
                'description' => 'This is a detailed description of Property ' . ($i + 1),
                'price' => rand(5000000, 20000000), // Random price between 5M and 20M
                'status' => $statuses[array_rand($statuses)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert the properties into the table
        DB::table('properties')->insert($properties);
    }
}
