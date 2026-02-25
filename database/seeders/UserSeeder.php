<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminPassword = 'admin123';
        $userPassword = 'user123';

        // Admin user
        $admin = User::updateOrCreate(
            ['email' => 'admin@aksaka.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make($adminPassword),
                'role' => 'admin',
            ]
        );

        // Regular user
        $user = User::updateOrCreate(
            ['email' => 'user@aksaka.com'],
            [
                'name' => 'User',
                'password' => Hash::make($userPassword),
                'role' => 'user',
            ]
        );

        $this->command->info('');
        $this->command->info('Users seeded:');
        $this->command->table(
            ['Name', 'Email', 'Password', 'Role'],
            [
                [$admin->name, $admin->email, $adminPassword, $admin->role],
                [$user->name, $user->email, $userPassword, $user->role],
            ]
        );
    }
}
