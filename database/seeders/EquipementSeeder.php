<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipement;
use App\Models\Fournisseur;

class EquipementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fournisseurs = Fournisseur::all();
        
        $equipements = [
            [
                'nom' => 'Ordinateur Portable Dell Latitude',
                'type' => 'Informatique',
                'actif' => true
            ],
            [
                'nom' => 'Imprimante HP LaserJet Pro',
                'type' => 'Périphérique',
                'actif' => true
            ],
            [
                'nom' => 'Scanner Canon CanoScan',
                'type' => 'Périphérique',
                'actif' => true
            ],
            [
                'nom' => 'Serveur HP ProLiant',
                'type' => 'Serveur',
                'actif' => true
            ],
            [
                'nom' => 'Switch Cisco Catalyst',
                'type' => 'Réseau',
                'actif' => true
            ],
            [
                'nom' => 'Routeur TP-Link Archer',
                'type' => 'Réseau',
                'actif' => true
            ],
            [
                'nom' => 'Projecteur Epson PowerLite',
                'type' => 'Audiovisuel',
                'actif' => true
            ],
            [
                'nom' => 'Caméra de Surveillance Hikvision',
                'type' => 'Sécurité',
                'actif' => true
            ],
            [
                'nom' => 'Système de Climatisation Carrier',
                'type' => 'Climatisation',
                'actif' => true
            ],
            [
                'nom' => 'Générateur Cummins',
                'type' => 'Énergie',
                'actif' => true
            ],
            [
                'nom' => 'Tablette Samsung Galaxy Tab',
                'type' => 'Mobile',
                'actif' => true
            ],
            [
                'nom' => 'Téléphone IP Yealink',
                'type' => 'Téléphonie',
                'actif' => true
            ],
            [
                'nom' => 'Écran LED Samsung',
                'type' => 'Affichage',
                'actif' => true
            ],
            [
                'nom' => 'Système de Son Bose',
                'type' => 'Audio',
                'actif' => true
            ],
            [
                'nom' => 'Machine à Café Nespresso',
                'type' => 'Électroménager',
                'actif' => true
            ]
        ];

        foreach ($equipements as $index => $equipement) {
            $equipement['fournisseur_id'] = $fournisseurs[$index % $fournisseurs->count()]->id;
            Equipement::create($equipement);
        }
    }
} 