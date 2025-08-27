<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entreprise;

class EntrepriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $entreprises = [
            [
                'nom' => 'TechSolutions SARL',
                'adresse' => '123 Avenue de la République, Douala',
                'secteur_activite' => 'Technologie',
                'telephone' => '+237 233 123 456',
                'email' => 'contact@techsolutions.cm',
                'actif' => true
            ],
            [
                'nom' => 'Industries Camerounaises',
                'adresse' => '456 Boulevard de l\'Indépendance, Yaoundé',
                'secteur_activite' => 'Industrie',
                'telephone' => '+237 222 234 567',
                'email' => 'info@industries-cm.com',
                'actif' => true
            ],
            [
                'nom' => 'AgroBusiness Plus',
                'adresse' => '789 Route de Kribi, Kribi',
                'secteur_activite' => 'Agriculture',
                'telephone' => '+237 233 345 678',
                'email' => 'contact@agrobusiness.cm',
                'actif' => true
            ],
            [
                'nom' => 'Construction Moderne',
                'adresse' => '321 Rue du Commerce, Bafoussam',
                'secteur_activite' => 'Construction',
                'telephone' => '+237 233 456 789',
                'email' => 'info@construction-moderne.cm',
                'actif' => true
            ],
            [
                'nom' => 'Services Financiers Cameroun',
                'adresse' => '654 Avenue Kennedy, Douala',
                'secteur_activite' => 'Finance',
                'telephone' => '+237 233 567 890',
                'email' => 'contact@sfc.cm',
                'actif' => true
            ],
            [
                'nom' => 'Transport Express',
                'adresse' => '987 Boulevard de l\'Avenir, Yaoundé',
                'secteur_activite' => 'Transport',
                'telephone' => '+237 222 678 901',
                'email' => 'info@transport-express.cm',
                'actif' => true
            ],
            [
                'nom' => 'Mines et Ressources',
                'adresse' => '147 Route de l\'Est, Bertoua',
                'secteur_activite' => 'Mines',
                'telephone' => '+237 233 789 012',
                'email' => 'contact@mines-ressources.cm',
                'actif' => true
            ],
            [
                'nom' => 'Énergie Verte Cameroun',
                'adresse' => '258 Avenue de la Paix, Garoua',
                'secteur_activite' => 'Énergie',
                'telephone' => '+237 233 890 123',
                'email' => 'info@energie-verte.cm',
                'actif' => true
            ],
            [
                'nom' => 'Télécommunications Plus',
                'adresse' => '369 Boulevard Central, Bamenda',
                'secteur_activite' => 'Télécommunications',
                'telephone' => '+237 233 901 234',
                'email' => 'contact@telecom-plus.cm',
                'actif' => true
            ],
            [
                'nom' => 'Santé et Bien-être',
                'adresse' => '741 Rue de la Santé, Buea',
                'secteur_activite' => 'Santé',
                'telephone' => '+237 233 012 345',
                'email' => 'info@sante-bienetre.cm',
                'actif' => true
            ],
            [
                'nom' => 'Éducation Excellence',
                'adresse' => '852 Avenue des Étudiants, Maroua',
                'secteur_activite' => 'Éducation',
                'telephone' => '+237 233 123 456',
                'email' => 'contact@education-excellence.cm',
                'actif' => true
            ],
            [
                'nom' => 'Commerce International',
                'adresse' => '963 Boulevard du Port, Douala',
                'secteur_activite' => 'Commerce',
                'telephone' => '+237 233 234 567',
                'email' => 'info@commerce-international.cm',
                'actif' => true
            ],
            [
                'nom' => 'Tourisme et Loisirs',
                'adresse' => '159 Route de la Plage, Kribi',
                'secteur_activite' => 'Tourisme',
                'telephone' => '+237 233 345 678',
                'email' => 'contact@tourisme-loisirs.cm',
                'actif' => true
            ],
            [
                'nom' => 'Logistique Avancée',
                'adresse' => '357 Avenue de la Logistique, Yaoundé',
                'secteur_activite' => 'Logistique',
                'telephone' => '+237 222 456 789',
                'email' => 'info@logistique-avancee.cm',
                'actif' => true
            ],
            [
                'nom' => 'Innovation et Recherche',
                'adresse' => '486 Rue de l\'Innovation, Douala',
                'secteur_activite' => 'Recherche',
                'telephone' => '+237 233 567 890',
                'email' => 'contact@innovation-recherche.cm',
                'actif' => true
            ]
        ];

        foreach ($entreprises as $entreprise) {
            Entreprise::create($entreprise);
        }
    }
} 