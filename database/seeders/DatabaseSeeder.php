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
        ]);

        $user = User::where('email', 'test@test.com')->first();
        if (is_null($user)){
            $user = \App\Models\User::factory(1)->create([
                'name' => 'Velonic',
                'email' => 'test@test.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => Str::random(10),
            ]);
        }

        $user->assignRole(['Super Admin']);
    }
}
