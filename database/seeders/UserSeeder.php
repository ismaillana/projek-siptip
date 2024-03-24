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
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin Corporate',
            'username' => 'admin',
            'email' => 'admincor@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('admin-corporate');
    }
}
