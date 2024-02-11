<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'admin-user-read', 'admin-user-write', 'admin-user-delete',
            'event-company-read', 'event-company-write', 'event-company-delete',
            'event-read', 'event-write', 'event-delete',
            'sponsor-type-read', 'sponsor-type-write', 'sponsor-type-delete',
            'sponsor-read', 'sponsor-write', 'sponsor-delete',
            'food-partner-read', 'food-partner-write', 'food-partner-delete',
            'food-type-read', 'food-type-write', 'food-type-delete',
            'food-event-read', 'food-event-write', 'food-event-delete',
            'food-menu-read', 'food-menu-write', 'food-menu-delete',
            'faqs-read', 'faqs-write', 'faqs-delete',
            'email-templates-read', 'email-templates-write',
            'custom-page-read', 'custom-page-write',
            'admin-roles-read', 'admin-roles-write',
            'configuration-read', 'configuration-write',
            'orders-read', 'app-users-read', 'app-users-write'
        ];
        foreach ($permissions as $permission){
            $permissionExist = Permission::where('name', $permission)->exists();
            if (!$permissionExist){
                Permission::create([
                    'name' => $permission,
                    'guard_name' => 'web',
                ]);
            }
        }
    }
}
