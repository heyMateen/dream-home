<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
      UsersTableSeeder::class,
      AppointmentsTableSeeder::class,
      StaffTableSeeder::class,
      PropertiesTableSeeder::class,
      PropertyImagesTableSeeder::class,
      TransactionsTableSeeder::class,
      BranchesTableSeeder::class,
    ]);
  }
}
