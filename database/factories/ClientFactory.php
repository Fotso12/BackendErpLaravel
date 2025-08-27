<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->company,
            'adresse' => $this->faker->address,
            'telephone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'entreprise_id' => 1, // Assurez-vous qu'une entreprise avec cet ID existe dans la base
            'actif' => true,
        ];
    }
}
