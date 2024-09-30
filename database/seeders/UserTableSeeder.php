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
                'first_name' => 'Mark Romel',
                'middle_name' => 'F',
                'last_name' => 'Feguro',
                'suffix' => '',
                'age' => 23,
                'gender_id' => 1,
                'role_id' => 1,
                'position_id' => 1,
                'email' => 'markromelfeguro1@gmail.com',
                'contact_no' => '09672812221',
                'password' => Hash::make('@Kaizen123'),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
