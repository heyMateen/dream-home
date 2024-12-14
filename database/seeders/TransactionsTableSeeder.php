<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch required IDs
        $propertyIds = DB::table('properties')->pluck('id')->toArray();
        $userIds = DB::table('users')->pluck('id')->toArray(); // For buyers
        $staffIds = DB::table('staff')->pluck('user_id')->toArray(); // For staff handling the transaction

        $statuses = ['pending', 'completed', 'failed'];

        $transactions = [];

        foreach ($propertyIds as $propertyId) {
            $transactions[] = [
                'property_id' => $propertyId,
                'buyer_id' => $userIds[array_rand($userIds)], // Random buyer
                'staff_id' => $staffIds[array_rand($staffIds)], // Random staff
                'amount' => rand(1000000, 10000000), // Random amount between 1M and 10M
                'status' => $statuses[array_rand($statuses)], // Random status
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert the transactions into the table
        DB::table('transactions')->insert($transactions);
    }
}
