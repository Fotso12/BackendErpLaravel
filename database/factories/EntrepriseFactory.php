<?php

namespace Database\Factories;

use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntrepriseFactory extends Factory
{
    protected $model = Entreprise::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->company,
            'adresse' => $this->faker->address,
            'secteur_activite' => $this->faker->word,
            'telephone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            // Ajouter d'autres champs si nécessaire
        ];
    }
}
