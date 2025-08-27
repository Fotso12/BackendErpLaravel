<?php

namespace Database\Factories;

use App\Models\Filiale;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilialeFactory extends Factory
{
    protected $model = Filiale::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->company,
            'adresse' => $this->faker->address,
            'secteur_activite' => $this->faker->word,
            'telephone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'entreprise_id' => 1, // Assurez-vous qu'une entreprise avec cet ID existe dans la base
            'actif' => true,
        ];
    }
}
