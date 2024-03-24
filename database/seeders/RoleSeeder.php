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
                'name'      => 'karyawan-senior',
                'guard_name'=> 'web'
            ],
            [
                'name'      => 'karyawan-junior',
                'guard_name'=> 'web'
            ],
        ];
    
        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['name' => $role['name'], 'guard_name' => $role['guard_name']],
                $role
            );
        }
    }
}
