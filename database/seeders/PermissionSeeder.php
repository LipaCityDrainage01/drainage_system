<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $permissions = [
            'dashboard',
            'admin-list',
            'admin-create',
            'admin-edit',
            'admin-delete',
            'driver-list',
            'driver-create',
            'driver-edit',
            'driver-delete',
            'driver-approve',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-approve',
            'fleet-list',
            'fleet-create',
            'fleet-edit',
            'fleet-delete',
            'booking-list',
            'booking-manage',
            'cancellation-list',
            'cancellation-manage',
            'rate-list',
            'rate-create',
            'rate-delete',
            'help-center-list',
            'help-center-manage',
            'sos-list',
            'sos-manage',
        ];
//
        foreach ($permissions as $permission){
            \Spatie\Permission\Models\Permission::create([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }
//        $roles = [
//            'Administrator',
//            'Support',
//            'Staff'
//        ];
//        foreach ($roles as $role){
//            \Spatie\Permission\Models\Role::create([
//                'name' => $role,
//            ]);
//        }
    }
}
