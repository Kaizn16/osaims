<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $current_date_time = Carbon::now();

        $departments_list = [
            ['department_name' => 'College of Teachers Education', 'abbreviation' => 'CTE', 'created_at' => $current_date_time],
            ['department_name' => 'College of Business and Accountancy', 'abbreviation' => 'CBA', 'created_at' => $current_date_time],
            ['department_name' => 'College of Arts and Sciences', 'abbreviation' => 'CAS', 'created_at' => $current_date_time],
            ['department_name' => 'College of Engineering', 'abbreviation' => 'COE', 'created_at' => $current_date_time],
            ['department_name' => 'College of Computer Studies', 'abbreviation' => 'CCS', 'created_at' => $current_date_time],
            ['department_name' => 'College of Hospitality, Tourism and Management', 'abbreviation' => 'CHTM', 'created_at' => $current_date_time],
            ['department_name' => 'College of Criminal Justice Education', 'abbreviation' => 'CCJE', 'created_at' => $current_date_time],
            ['department_name' => 'College of Nursing', 'abbreviation' => 'CN', 'created_at' => $current_date_time],
        ];

        DB::table('departments')->insert($departments_list);
    }
}
