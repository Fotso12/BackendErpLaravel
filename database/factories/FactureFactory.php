<?php

namespace Database\Factories;

use App\Models\Facture;
use Illuminate\Database\Eloquent\Factories\Factory;

class FactureFactory extends Factory
{
    protected $model = Facture::class;

    public function definition()
    {
        return [
            'client_id' => 1, // Assurez-vous qu'un client avec cet ID existe dans la base
            'montant' => $this->faker->randomFloat(2, 100, 10000),
            'date_echeance' => $this->faker->date(),
            'description' => $this->faker->sentence,
        ];
    }
}
