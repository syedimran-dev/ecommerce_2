<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('12345');
        $registerUser = [
                 [
                    'id'=> 1,'name' => 'admin', 'email' => 'admin@gmail.com', 'mobile' => '203943043', 'image' => '', 'password' => $password, 'type' => 'admin', 'status' => 1,
                    'id'=> 2,'name' => 'jhon', 'email' => 'jhon@gmail.com', 'mobile' => '203943045', 'image' => '', 'password' => $password, 'type' => 'subadmin', 'status' => 1,
                    'id'=> 3,'name' => 'doe', 'email' => 'doe@gmail.com', 'mobile' => '203943046', 'image' => '', 'password' => $password, 'type' => 'subadmin', 'status' => 1,
                 ]
        ];

        Admin::insert($registerUser);
    }
}
