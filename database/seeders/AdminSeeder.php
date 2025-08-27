<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Exécute le seeder pour créer un administrateur.
     */
    public function run(): void
    {
        // On suppose que le rôle admin existe déjà (id=1 ou nom='admin')
        $role = Role::where('nom', 'admin')->first();
        if (!$role) {
            $role = Role::create([
                'nom' => 'admin',
                'description' => 'Administrateur',
            ]);
        }
        Utilisateur::updateOrCreate(
            [ 'email' => 'tamofotso90@gmail.com' ],
            [
                'nom' => 'Admin',
                'prenom' => 'Super',
                'email' => 'tamofotso90@gmail.com',
                'mot_de_passe' => Hash::make('20021204'),
                'role_id' => $role->id,
                'actif' => true,
            ]
        );
    }
} 