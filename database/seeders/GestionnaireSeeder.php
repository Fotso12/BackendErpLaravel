<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class GestionnaireSeeder extends Seeder
{
    /**
     * Exécute le seeder pour créer un gestionnaire.
     */
    public function run(): void
    {
        // On suppose que le rôle gestionnaire existe déjà
        $role = Role::where('nom', 'gestionnaire')->first();
        if (!$role) {
            $role = Role::create([
                'nom' => 'gestionnaire',
                'description' => 'Gestionnaire des opérations',
            ]);
        }
        Utilisateur::updateOrCreate(
            ['email' => 'gestionnaire@example.com'],
            [
                'nom' => 'Gestionnaire',
                'prenom' => 'Standard',
                'email' => 'gestionnaire@example.com',
                'mot_de_passe' => Hash::make('12345678'),
                'role_id' => $role->id,
                'actif' => true,
            ]
        );
    }
}
