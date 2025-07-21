<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Quick Explanation
        // *
        // 1. admin@gmail.com / admin@example.com
        // 2. user@gmail.com / user@example.com
        // 3. admin(1-5)* / user(1-5) example.com
        // *

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $verifiedAt = Carbon::now();

        // Admins
        $admin = User::create([
            'name' => "Admin",
            'email' => "admin@example.com",
            'password' => Hash::make('password'),
            'email_verified_at' => $verifiedAt,
        ]);

        $admin = User::create([
            'name' => "Admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => $verifiedAt,
        ]);

        $admin->assignRole($adminRole);
        for ($i = 1; $i <= 2; $i++) {
            $admin = User::create([
                'name' => "Admin $i",
                'email' => "admin$i@example.com",
                'password' => Hash::make('password'),
                'email_verified_at' => $verifiedAt,
            ]);
            $admin->assignRole($adminRole);
        }

        // Users
        $user = User::create([
            'name' => "User",
            'email' => "user@example.com",
            'password' => Hash::make('password'),
            'email_verified_at' => $verifiedAt,
        ]);
        $user->assignRole($userRole);

        $user = User::create([
            'name' => "User",
            'email' => "user@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => $verifiedAt,
        ]);
        $user->assignRole($userRole);

        for ($i = 1; $i <= 2; $i++) {
            $user = User::create([
                'name' => "User $i",
                'email' => "user$i@example.com",
                'password' => Hash::make('password'),
                'email_verified_at' => $verifiedAt,
            ]);
            $user->assignRole($userRole);
        }
    }
}
