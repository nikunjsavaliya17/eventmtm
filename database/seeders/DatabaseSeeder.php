<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
            EmailTemplateDataSeeder::class,
        ]);

        $user = User::where('email', 'test@test.com')->first();
        if (is_null($user)){
            $user = User::create([
                'name' => 'Super Admin',
                'email' => 'super_admin@gmail.com',
                'password' => '123456',
                'is_active' => 1
            ]);
        }

        $user->assignRole(['Super Admin']);
    }
}
