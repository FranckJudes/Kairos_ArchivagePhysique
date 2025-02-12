<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $existingAdmin = DB::table('users')->where('email', 'admin@example.com')->first();

        if (!$existingAdmin) {
            DB::table('users')->insert([
                'firstname' => 'Admin',
                'lastname' => 'User',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'status' => 'active',
                'phone' => '23700000007',
                'birthday' => '01-01-1900',
                'password' => Hash::make('password'),
                'bio' => 'I am the administrator.',
                'theme_preference' => 'iconcolor gradient font-opensans',
                'type_utilisateur' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->command->info('Admin user created successfully.');
        } else {
            $this->command->info('Admin user already exists. Skipping.');
        }
    }
}
