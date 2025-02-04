<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DomaineValeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('domaine_valeurs')->insert([
            'libele' => 'Fonction des intervenants',
            'description' => 'Liste des fonctions associées aux intervenants.',
            'type' => '1', // Peut être supprimé
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('domaine_valeurs')->insert([
            'libele' => 'Activites',
            'description' => 'Liste des activites associées aux intervenants.',
            'type' => '1', // Peut être supprimé
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('domaine_valeurs')->insert([
            'libele' => 'Typologie documentaire',
            'description' => 'Liste des typologies documentaires associées aux intervenants.',
            'type' => '1', // Peut être supprimé
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('domaine_valeurs')->insert([
            'libele' => 'Periodicite',
            'description' => 'Liste des periodicites.',
            'type' => '1', // Peut être supprimé
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('domaine_valeurs')->insert([
            'libele' => 'unites',
            'description' => 'Liste des unites.',
            'type' => '1', // Peut être supprimé
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
