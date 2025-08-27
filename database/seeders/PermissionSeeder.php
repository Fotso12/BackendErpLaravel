<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Exécute le seeder pour les permissions.
     */
    public function run(): void
    {
        // Création des permissions de base
        $permissions = [
            ['nom' => 'voir_utilisateurs', 'description' => 'Peut voir la liste des utilisateurs'],
            ['nom' => 'creer_utilisateur', 'description' => 'Peut créer un utilisateur'],
            ['nom' => 'modifier_utilisateur', 'description' => 'Peut modifier un utilisateur'],
            ['nom' => 'supprimer_utilisateur', 'description' => 'Peut supprimer un utilisateur'],
            ['nom' => 'creer_entreprise', 'description' => 'Peut créer une entreprise'],
            ['nom' => 'modifier_entreprise', 'description' => 'Peut modifier une entreprise'],
            ['nom' => 'supprimer_entreprise', 'description' => 'Peut supprimer une entreprise'],
            ['nom' => 'voir_entreprises', 'description' => 'Peut voir la liste des entreprises'],
            // Ajouter d'autres permissions selon les besoins du cahier des charges
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}