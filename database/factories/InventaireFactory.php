<?php

namespace Database\Factories;

use App\Models\Inventaire;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventaireFactory extends Factory
{
    protected $model = Inventaire::class;

    public function definition()
    {
        return [
            'depot_id' => 1, // Assurez-vous qu'un dépôt avec cet ID existe dans la base
            'equipement_id' => 1, // Assurez-vous qu'un équipement avec cet ID existe dans la base
            'quantite' => $this->faker->numberBetween(1, 100),
            'date_inventaire' => $this->faker->date(),
        ];
    }
}
