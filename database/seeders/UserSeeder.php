<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data1 = [
            'name' => 'User 1',
            'email' => 'user1@example.com',
            'password' => bcrypt('12345678'),
        ];

        $user1 = User::create($data1);
        $user1->assignRole('admin');



        $data2 = [
            'name' => 'User 2',
            'email' => 'user2@example.com',
            'password' => bcrypt('123456789'),
        ];

        $user2 = User::create($data2);
        $user2->assignRole('superAdmin');
    }
}
