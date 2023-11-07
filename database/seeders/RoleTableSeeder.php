<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Super Admin', 'Event Admin', 'Food Partner'
        ];
        foreach ($roles as $role){
            $roleExist = Role::where('name', $role)->exists();
            if (!$roleExist){
                Role::create([
                    'name' => $role,
                    'guard_name' => 'web',
                ]);
            }
        }
    }
}
