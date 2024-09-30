<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AvailabilityStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $availability_statuses = [
            ['status_type' => 'Leave'],
            ['status_type' => 'Office'],
        ];

        DB::table('availability_status')->insert($availability_statuses);
    }
}
