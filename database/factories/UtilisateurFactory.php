<?php

namespace Database\Factories;

use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UtilisateurFactory extends Factory
{
    protected $model = Utilisateur::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'mot_de_passe' => bcrypt('password'), // mot de passe par défaut
            'role_id' => 1, // Assurez-vous qu'un rôle avec cet ID existe dans la base
            'actif' => true,
            'remember_token' => Str::random(10),
        ];
    }
}
