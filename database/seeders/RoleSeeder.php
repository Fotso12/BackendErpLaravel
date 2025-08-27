<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Exécute le seeder pour les rôles.
     */
    public function run(): void
    {
        // Création des rôles de base
        $roles = [
            ['nom' => 'admin', 'description' => 'Administrateur du système'],
            ['nom' => 'gestionnaire', 'description' => 'Gestionnaire des opérations'],
            ['nom' => 'utilisateur', 'description' => 'Utilisateur standard'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['nom' => $role['nom']],
                ['description' => $role['description']]
            );
        }
    }
}
