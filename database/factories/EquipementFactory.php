<?php

namespace Database\Factories;

use App\Models\Equipement;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipementFactory extends Factory
{
    protected $model = Equipement::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'type' => $this->faker->word,
            'fournisseur_id' => \App\Models\Fournisseur::factory(),
            'actif' => true,
        ];
    }
}
