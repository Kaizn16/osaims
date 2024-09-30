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
        $this->call(GendersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(AvailabilityStatusTableSeeder::class);
        $this->call(AppointmentStatusTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
