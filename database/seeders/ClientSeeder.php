<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Entreprise;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $entreprises = Entreprise::all();
        
        $clients = [
            [
                'nom' => 'Jean Dupont',
                'adresse' => '123 Rue de la Paix, Douala',
                'telephone' => '+237 233 111 111',
                'email' => 'jean.dupont@email.com',
                'actif' => true
            ],
            [
                'nom' => 'Marie Martin',
                'adresse' => '456 Avenue des Fleurs, Yaoundé',
                'telephone' => '+237 222 222 222',
                'email' => 'marie.martin@email.com',
                'actif' => true
            ],
            [
                'nom' => 'Pierre Durand',
                'adresse' => '789 Boulevard Central, Bafoussam',
                'telephone' => '+237 233 333 333',
                'email' => 'pierre.durand@email.com',
                'actif' => true
            ],
            [
                'nom' => 'Sophie Bernard',
                'adresse' => '321 Route de l\'Est, Kribi',
                'telephone' => '+237 233 444 444',
                'email' => 'sophie.bernard@email.com',
                'actif' => true
            ],
            [
                'nom' => 'Michel Petit',
                'adresse' => '654 Rue du Commerce, Bamenda',
                'telephone' => '+237 233 555 555',
                'email' => 'michel.petit@email.com',
                'actif' => true
            ],
            [
                'nom' => 'Isabelle Moreau',
                'adresse' => '987 Avenue Kennedy, Garoua',
                'telephone' => '+237 233 666 666',
                'email' => 'isabelle.moreau@email.com',
                'actif' => true
            ],
            [
                'nom' => 'François Leroy',
                'adresse' => '147 Boulevard de l\'Avenir, Bertoua',
                'telephone' => '+237 233 777 777',
                'email' => 'francois.leroy@email.com',
                'actif' => true
            ],
            [
                'nom' => 'Catherine Roux',
                'adresse' => '258 Rue de la Santé, Buea',
                'telephone' => '+237 233 888 888',
                'email' => 'catherine.roux@email.com',
                'actif' => true
            ],
            [
                'nom' => 'Philippe Simon',
                'adresse' => '369 Avenue des Étudiants, Maroua',
                'telephone' => '+237 233 999 999',
                'email' => 'philippe.simon@email.com',
                'actif' => true
            ],
            [
                'nom' => 'Nathalie Michel',
                'adresse' => '741 Boulevard du Port, Douala',
                'telephone' => '+237 233 000 000',
                'email' => 'nathalie.michel@email.com',
                'actif' => true
            ],
            [
                'nom' => 'David Garcia',
                'adresse' => '852 Route de la Plage, Kribi',
                'telephone' => '+237 233 111 222',
                'email' => 'david.garcia@email.com',
                'actif' => true
            ],
            [
                'nom' => 'Anne Rodriguez',
                'adresse' => '963 Avenue de la Logistique, Yaoundé',
                'telephone' => '+237 222 333 444',
                'email' => 'anne.rodriguez@email.com',
                'actif' => true
            ],
            [
                'nom' => 'Thomas Lopez',
                'adresse' => '159 Rue de l\'Innovation, Douala',
                'telephone' => '+237 233 444 555',
                'email' => 'thomas.lopez@email.com',
                'actif' => true
            ],
            [
                'nom' => 'Julie Martinez',
                'adresse' => '357 Boulevard Central, Bafoussam',
                'telephone' => '+237 233 555 666',
                'email' => 'julie.martinez@email.com',
                'actif' => true
            ],
            [
                'nom' => 'Marc Gonzalez',
                'adresse' => '486 Avenue des Fleurs, Yaoundé',
                'telephone' => '+237 222 666 777',
                'email' => 'marc.gonzalez@email.com',
                'actif' => true
            ]
        ];

        foreach ($clients as $index => $client) {
            $client['entreprise_id'] = $entreprises[$index % $entreprises->count()]->id;
            Client::create($client);
        }
    }
} 