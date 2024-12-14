<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Assuming you already have users and branches in the database
        $userIds = DB::table('users')->pluck('id')->toArray();
        $branchIds = DB::table('branches')->pluck('id')->toArray();

        $roles = ['manager', 'employee'];

        $staffMembers = [];

        for ($i = 0; $i < 10; $i++) {
            $staffMembers[] = [
                'user_id' => $userIds[array_rand($userIds)],
                'branch_id' => $branchIds[array_rand($branchIds)],
                'role' => $roles[array_rand($roles)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('staff')->insert($staffMembers);
    }
}
