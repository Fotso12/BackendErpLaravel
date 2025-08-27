<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Appel des seeders pour les rôles et permissions
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            AdminSeeder::class,
            GestionnaireSeeder::class,
            EntrepriseSeeder::class,
            FournisseurSeeder::class,
            EquipementSeeder::class,
            MissionSeeder::class,
            UtilisateurSeeder::class,
            ClientSeeder::class,
        ]);
    }
}
