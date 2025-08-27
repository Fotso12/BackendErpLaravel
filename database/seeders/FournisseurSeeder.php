<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fournisseur;

class FournisseurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fournisseurs = [
            [
                'nom' => 'TechSupply Cameroun',
                'adresse' => '123 Avenue de la Technologie, Douala',
                'telephone' => '+237 233 111 000',
                'email' => 'contact@techsupply.cm'
            ],
            [
                'nom' => 'Equipements Pro SARL',
                'adresse' => '456 Boulevard des Fournisseurs, Yaoundé',
                'telephone' => '+237 222 222 111',
                'email' => 'info@equipements-pro.cm'
            ],
            [
                'nom' => 'Materiaux Express',
                'adresse' => '789 Rue du Matériel, Bafoussam',
                'telephone' => '+237 233 333 222',
                'email' => 'contact@materiaux-express.cm'
            ],
            [
                'nom' => 'Fournitures Industrielles',
                'adresse' => '321 Avenue de l\'Industrie, Kribi',
                'telephone' => '+237 233 444 333',
                'email' => 'info@fournitures-industrielles.cm'
            ],
            [
                'nom' => 'Outillage Moderne',
                'adresse' => '654 Boulevard des Outils, Bamenda',
                'telephone' => '+237 233 555 444',
                'email' => 'contact@outillage-moderne.cm'
            ],
            [
                'nom' => 'Machines et Équipements',
                'adresse' => '987 Rue des Machines, Garoua',
                'telephone' => '+237 233 666 555',
                'email' => 'info@machines-equipements.cm'
            ],
            [
                'nom' => 'Fournisseur Premium',
                'adresse' => '147 Avenue Premium, Bertoua',
                'telephone' => '+237 233 777 666',
                'email' => 'contact@fournisseur-premium.cm'
            ],
            [
                'nom' => 'Équipements Spécialisés',
                'adresse' => '258 Boulevard Spécialisé, Buea',
                'telephone' => '+237 233 888 777',
                'email' => 'info@equipements-specialises.cm'
            ],
            [
                'nom' => 'Matériel Professionnel',
                'adresse' => '369 Rue Professionnelle, Maroua',
                'telephone' => '+237 233 999 888',
                'email' => 'contact@materiel-professionnel.cm'
            ],
            [
                'nom' => 'Fournitures Express',
                'adresse' => '741 Avenue Express, Douala',
                'telephone' => '+237 233 000 999',
                'email' => 'info@fournitures-express.cm'
            ],
            [
                'nom' => 'Équipements de Qualité',
                'adresse' => '852 Boulevard de la Qualité, Kribi',
                'telephone' => '+237 233 111 000',
                'email' => 'contact@equipements-qualite.cm'
            ],
            [
                'nom' => 'Matériaux Avancés',
                'adresse' => '963 Rue Avancée, Yaoundé',
                'telephone' => '+237 222 222 111',
                'email' => 'info@materiaux-avances.cm'
            ],
            [
                'nom' => 'Fournisseur Innovant',
                'adresse' => '159 Avenue de l\'Innovation, Douala',
                'telephone' => '+237 233 333 222',
                'email' => 'contact@fournisseur-innovant.cm'
            ],
            [
                'nom' => 'Équipements Durables',
                'adresse' => '357 Boulevard Durable, Bafoussam',
                'telephone' => '+237 233 444 333',
                'email' => 'info@equipements-durables.cm'
            ],
            [
                'nom' => 'Matériel Expert',
                'adresse' => '486 Rue de l\'Expertise, Yaoundé',
                'telephone' => '+237 222 555 444',
                'email' => 'contact@materiel-expert.cm'
            ]
        ];

        foreach ($fournisseurs as $fournisseur) {
            Fournisseur::create($fournisseur);
        }
    }
} 