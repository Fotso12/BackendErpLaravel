<?php

namespace Database\Factories;

use App\Models\MouvementStock;
use Illuminate\Database\Eloquent\Factories\Factory;

class MouvementStockFactory extends Factory
{
    protected $model = MouvementStock::class;

    public function definition()
    {
        return [
            'depot_id' => 1, // Assurez-vous qu'un dépôt avec cet ID existe dans la base
            'equipement_id' => 1, // Assurez-vous qu'un équipement avec cet ID existe dans la base
            'type_mouvement' => $this->faker->randomElement(['entrée', 'sortie']),
            'quantite' => $this->faker->numberBetween(1, 100),
            'date_mouvement' => $this->faker->date(),
        ];
    }
}
