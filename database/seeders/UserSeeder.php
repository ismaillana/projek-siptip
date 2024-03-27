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
        $user = User::updateOrCreate(
            ['email' => 'admincor@gmail.com'], 
            [
                'name' => 'Admin Corporate',
                'username' => 'admin_corporate',
                'email' => 'admincor@gmail.com',
                'password' => Hash::make('password'),
            ]
        );
        
        $user->assignRole('admin-corporate');
        
        $user = User::updateOrCreate(
            ['email' => 'adminit@gmail.com'], 
            [
                'name' => 'Admin IT',
                'username' => 'admin_it', 
                'email' => 'adminit@gmail.com',
                'password' => Hash::make('password'),
            ]
        );
        
        $user->assignRole('admin-it');

        $user = User::updateOrCreate(
            ['email' => 'manager@gmail.com'], 
            [
                'name' => 'Manager',
                'username' => 'manager', 
                'email' => 'manager@gmail.com',
                'password' => Hash::make('password'),
            ]
        );
        
        $user->assignRole('manager');
    }
}
