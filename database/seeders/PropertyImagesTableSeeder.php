<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch all property IDs
        $propertyIds = DB::table('properties')->pluck('id')->toArray();

        $propertyImages = [];

        foreach ($propertyIds as $propertyId) {
            // Each property will have 3 to 5 images
            $numberOfImages = rand(3, 5);

            for ($i = 1; $i <= $numberOfImages; $i++) {
                $propertyImages[] = [
                    'property_id' => $propertyId,
                    'image_path' => "property_{$propertyId}.jpg", // Fake image name
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert the property images into the table
        DB::table('property_images')->insert($propertyImages);
    }
}
