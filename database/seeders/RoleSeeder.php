<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name'      => 'admin-corporate',
                'guard_name'=> 'web'
            ],
            [
                'name'      => 'admin-it',
                'guard_name'=> 'web'
            ],
            [
                'name'      => 'manager',
                'guard_name'=> 'web'
            ],
            [
                'name'      => 'karyawan',
                'guard_name'=> 'web'
            ],
        ];
    
        Role::insert($roles);
    }
}
