<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appointment_statuses = [
            ['status_type' => 'Accepted'],
            ['status_type' => 'Decline'],
            ['status_type' => 'Resolved'],
        ];

        DB::table('appointment_status')->insert($appointment_statuses);
    }
}
