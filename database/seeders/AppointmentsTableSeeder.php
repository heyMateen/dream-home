<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch IDs for foreign keys
        $staffIds = DB::table('staff')->pluck('user_id')->toArray();
        $clientIds = DB::table('users')->pluck('id')->toArray(); // Assuming clients are users
        $propertyIds = DB::table('properties')->pluck('id')->toArray();

        $appointments = [];

        // Generate 20 appointments
        for ($i = 0; $i < 20; $i++) {
            $staffId = $staffIds[array_rand($staffIds)];
            $appointmentDate = now()->addDays(rand(1, 30))->setTime(rand(9, 17), 0); // Random date and time in the next 30 days

            $appointments[] = [
                'staff_id' => $staffId,
                'client_id' => $clientIds[array_rand($clientIds)],
                'property_id' => $propertyIds[array_rand($propertyIds)],
                'appointment_date' => $appointmentDate,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert appointments while ensuring unique combinations for staff and date
        $appointments = collect($appointments)
            ->unique(fn($appointment) => $appointment['staff_id'] . '_' . $appointment['appointment_date'])
            ->values()
            ->toArray();

        DB::table('appointments')->insert($appointments);
    }
}
