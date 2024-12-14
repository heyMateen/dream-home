<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branches')->insert([
            [
                'name' => 'Lahore Branch',
                'address' => '123 Main Street',
                'postal_code' => '54000',
                'city' => 'Lahore',
                'state' => 'Punjab',
                'country' => 'Pakistan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Karachi Branch',
                'address' => '456 Clifton Road',
                'postal_code' => '75500',
                'city' => 'Karachi',
                'state' => 'Sindh',
                'country' => 'Pakistan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Islamabad Branch',
                'address' => '789 Blue Area',
                'postal_code' => '44000',
                'city' => 'Islamabad',
                'state' => 'Islamabad Capital Territory',
                'country' => 'Pakistan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Faisalabad Branch',
                'address' => '101 Faisal Street',
                'postal_code' => '38000',
                'city' => 'Faisalabad',
                'state' => 'Punjab',
                'country' => 'Pakistan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Peshawar Branch',
                'address' => '202 Saddar Bazaar',
                'postal_code' => '25000',
                'city' => 'Peshawar',
                'state' => 'Khyber Pakhtunkhwa',
                'country' => 'Pakistan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Quetta Branch',
                'address' => '303 Zarghoon Road',
                'postal_code' => '87300',
                'city' => 'Quetta',
                'state' => 'Balochistan',
                'country' => 'Pakistan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Multan Branch',
                'address' => '404 Gulgasht Colony',
                'postal_code' => '60000',
                'city' => 'Multan',
                'state' => 'Punjab',
                'country' => 'Pakistan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sialkot Branch',
                'address' => '505 Wazirabad Road',
                'postal_code' => '51310',
                'city' => 'Sialkot',
                'state' => 'Punjab',
                'country' => 'Pakistan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hyderabad Branch',
                'address' => '606 Saddar Road',
                'postal_code' => '71000',
                'city' => 'Hyderabad',
                'state' => 'Sindh',
                'country' => 'Pakistan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gujranwala Branch',
                'address' => '707 Civil Lines',
                'postal_code' => '52250',
                'city' => 'Gujranwala',
                'state' => 'Punjab',
                'country' => 'Pakistan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
