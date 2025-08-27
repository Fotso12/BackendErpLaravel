<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Utilisateur;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UtilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::all();
        
        $utilisateurs = [
            [
                'nom' => 'Dupont',
                'prenom' => 'Jean',
                'email' => 'jean.dupont@entreprise.com',
                'mot_de_passe' => '1234',
                'actif' => true
            ],
            [
                'nom' => 'Martin',
                'prenom' => 'Marie',
                'email' => 'marie.martin@entreprise.com',
                'mot_de_passe' => '1234',
                'actif' => true
            ],
            [
                'nom' => 'Durand',
                'prenom' => 'Pierre',
                'email' => 'pierre.durand@entreprise.com',
                'mot_de_passe' => '1234',
                'actif' => true
            ],
            [
                'nom' => 'Bernard',
                'prenom' => 'Sophie',
                'email' => 'sophie.bernard@entreprise.com',
                'mot_de_passe' => '1234',
                'actif' => true
            ],
            [
                'nom' => 'Petit',
                'prenom' => 'Michel',
                'email' => 'michel.petit@entreprise.com',
                'mot_de_passe' => '1234',
                'actif' => true
            ],
            [
                'nom' => 'Moreau',
                'prenom' => 'Isabelle',
                'email' => 'isabelle.moreau@entreprise.com',
                'mot_de_passe' => '1234',
                'actif' => true
            ],
            [
                'nom' => 'Leroy',
                'prenom' => 'François',
                'email' => 'francois.leroy@entreprise.com',
                'mot_de_passe' => '1234',
                'actif' => true
            ],
            [
                'nom' => 'Roux',
                'prenom' => 'Catherine',
                'email' => 'catherine.roux@entreprise.com',
                'mot_de_passe' => '1234',
                'actif' => true
            ],
            [
                'nom' => 'Simon',
                'prenom' => 'Philippe',
                'email' => 'philippe.simon@entreprise.com',
                'mot_de_passe' => '1234',
                'actif' => true
            ],
            [
                'nom' => 'Michel',
                'prenom' => 'Nathalie',
                'email' => 'nathalie.michel@entreprise.com',
                'mot_de_passe' => '1234',
                'actif' => true
            ],
            [
                'nom' => 'Garcia',
                'prenom' => 'David',
                'email' => 'david.garcia@entreprise.com',
                'mot_de_passe' => '1234',
                'actif' => true
            ],
            [
                'nom' => 'Rodriguez',
                'prenom' => 'Anne',
                'email' => 'anne.rodriguez@entreprise.com',
                'mot_de_passe' => '1234',
                'actif' => true
            ],
            [
                'nom' => 'Lopez',
                'prenom' => 'Thomas',
                'email' => 'thomas.lopez@entreprise.com',
                'mot_de_passe' => '1234',
                'actif' => true
            ],
            [
                'nom' => 'Martinez',
                'prenom' => 'Julie',
                'email' => 'julie.martinez@entreprise.com',
                'mot_de_passe' => '1234',
                'actif' => true
            ],
            [
                'nom' => 'Gonzalez',
                'prenom' => 'Marc',
                'email' => 'marc.gonzalez@entreprise.com',
                'mot_de_passe' => '1234',
                'actif' => true
            ]
        ];

        foreach ($utilisateurs as $index => $utilisateur) {
            $utilisateur['mot_de_passe'] = Hash::make($utilisateur['mot_de_passe']);
            // Assigner des rôles de manière cyclique (utilisateur, gestionnaire, utilisateur, etc.)
            $roleIndex = ($index % 3) + 1; // 1=utilisateur, 2=gestionnaire, 3=admin
            $utilisateur['role_id'] = $roles->where('id', $roleIndex)->first()->id;
            
            Utilisateur::create($utilisateur);
        }
    }
} 