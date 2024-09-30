<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            ['position_type' => 'director'],
            ['position_type' => 'secretary'],
            ['position_type' => 'working student'],
        ];

        DB::table('positions')->insert($positions);
    }
}
