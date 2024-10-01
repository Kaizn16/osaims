<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'FCU-admin',
                'fullname' => 'Mark Romel F. Feguro',
                'age' => 23,
                'sex' => 'Male',
                'role_id' => 1,
                'position_id' => 1,
                'email' => 'markromelfeguro1@gmail.com',
                'contact_no' => '09672812221',
                'password' => Hash::make('@Kaizen123'),
                'availability_status_id' => 1,
            ],
        ];

        DB::table('users')->insert($users);
    }
}
