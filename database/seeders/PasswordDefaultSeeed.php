<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PasswordDefaultSeeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('password_defaults')->insert([
            'libele' => 'mot_de_passe_par_defaut',
            'valeur' => 'password',
            'description' => 'Mot de passe par défaut pour les nouveaux utilisateurs.',
            'type' => '0', // Or '1' if needed
            'created_at' => now(), // Add timestamps
            'updated_at' => now(),
        ]);
    }
}
