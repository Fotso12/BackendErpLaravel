<?php

namespace Database\Factories;

use App\Models\EntreeStock;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntreeStockFactory extends Factory
{
    protected $model = EntreeStock::class;

    public function definition()
    {
        return [
            'depot_id' => 1, // Assurez-vous qu'un dépôt avec cet ID existe dans la base
            'equipement_id' => 1, // Assurez-vous qu'un équipement avec cet ID existe dans la base
            'quantite' => $this->faker->numberBetween(1, 100),
            'date_entree' => $this->faker->date(),
        ];
    }
}
