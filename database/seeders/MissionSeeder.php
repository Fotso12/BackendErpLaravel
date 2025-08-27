<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mission;

class MissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $missions = [
            [
                'nom' => 'Maintenance Réseau Informatique',
                'description' => 'Maintenance préventive du réseau informatique de l\'entreprise',
                'date_debut' => '2024-01-15',
                'date_fin' => '2024-01-20'
            ],
            [
                'nom' => 'Installation Nouveaux Équipements',
                'description' => 'Installation et configuration de nouveaux équipements informatiques',
                'date_debut' => '2024-01-22',
                'date_fin' => '2024-01-25'
            ],
            [
                'nom' => 'Audit Sécurité Système',
                'description' => 'Audit complet de la sécurité des systèmes informatiques',
                'date_debut' => '2024-02-01',
                'date_fin' => '2024-02-10'
            ],
            [
                'nom' => 'Formation Utilisateurs',
                'description' => 'Formation des utilisateurs sur les nouveaux logiciels',
                'date_debut' => '2024-02-15',
                'date_fin' => '2024-02-18'
            ],
            [
                'nom' => 'Sauvegarde Données',
                'description' => 'Mise en place du système de sauvegarde automatique',
                'date_debut' => '2024-02-20',
                'date_fin' => '2024-02-22'
            ],
            [
                'nom' => 'Migration Serveur',
                'description' => 'Migration des données vers le nouveau serveur',
                'date_debut' => '2024-03-01',
                'date_fin' => '2024-03-05'
            ],
            [
                'nom' => 'Mise à Jour Logiciels',
                'description' => 'Mise à jour de tous les logiciels de l\'entreprise',
                'date_debut' => '2024-03-10',
                'date_fin' => '2024-03-12'
            ],
            [
                'nom' => 'Configuration VPN',
                'description' => 'Configuration du VPN pour le télétravail',
                'date_debut' => '2024-03-15',
                'date_fin' => '2024-03-17'
            ],
            [
                'nom' => 'Inventaire Équipements',
                'description' => 'Inventaire complet de tous les équipements informatiques',
                'date_debut' => '2024-03-20',
                'date_fin' => '2024-03-25'
            ],
            [
                'nom' => 'Optimisation Performance',
                'description' => 'Optimisation des performances du système informatique',
                'date_debut' => '2024-04-01',
                'date_fin' => '2024-04-05'
            ],
            [
                'nom' => 'Installation Antivirus',
                'description' => 'Installation et configuration de l\'antivirus sur tous les postes',
                'date_debut' => '2024-04-10',
                'date_fin' => '2024-04-12'
            ],
            [
                'nom' => 'Configuration Email',
                'description' => 'Configuration du système de messagerie électronique',
                'date_debut' => '2024-04-15',
                'date_fin' => '2024-04-17'
            ],
            [
                'nom' => 'Maintenance Climatisation',
                'description' => 'Maintenance des systèmes de climatisation des salles serveurs',
                'date_debut' => '2024-04-20',
                'date_fin' => '2024-04-22'
            ],
            [
                'nom' => 'Installation Caméras',
                'description' => 'Installation du système de vidéosurveillance',
                'date_debut' => '2024-04-25',
                'date_fin' => '2024-04-30'
            ],
            [
                'nom' => 'Configuration WiFi',
                'description' => 'Configuration du réseau WiFi pour les visiteurs',
                'date_debut' => '2024-05-01',
                'date_fin' => '2024-05-03'
            ]
        ];

        foreach ($missions as $mission) {
            Mission::create($mission);
        }
    }
} 