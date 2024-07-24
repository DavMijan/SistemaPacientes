<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        $users = [
            [
                'name' => 'SuperAdmin',
                'email' => 'superadmin@gmail.com',
                'password' => 'q1w2e3r4',
                'role' => 'superadmin',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => 'q1w2e3r4',
                'role' => 'admin',
            ],
            [
                'name' => 'Digitador',
                'email' => 'digitador@gmail.com',
                'password' => 'q1w2e3r4',
                'role' => 'digitador',
            ]
        ];

        foreach($users as $user) {
            $created_user = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);

            $created_user->assignRole($user['role']);
        }
    }
}
