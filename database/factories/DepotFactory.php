<?php

namespace Database\Factories;

use App\Models\Depot;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepotFactory extends Factory
{
    protected $model = Depot::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->company,
            'adresse' => $this->faker->address,
            'entreprise_id' => 1, // Assurez-vous qu'une entreprise avec cet ID existe dans la base
            'actif' => true,
        ];
    }
}
