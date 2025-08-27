<?php

namespace Database\Factories;

use App\Models\FamilleEquipement;
use Illuminate\Database\Eloquent\Factories\Factory;

class FamilleEquipementFactory extends Factory
{
    protected $model = FamilleEquipement::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'description' => $this->faker->sentence,
            'actif' => true,
        ];
    }
}
