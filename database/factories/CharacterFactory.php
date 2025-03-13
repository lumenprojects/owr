<?php

namespace Database\Factories;

use App\Models\Character;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    /**
     * Определение состояния модели.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement([
                'doom', 'dva', 'hammond', 'mauga', 'rein', 'winton',
                'junk', 'symmetra', 'tracer', 'venture', 'juno', 'kiriko',
                'lifeweaver', 'lucio', 'mercy'
            ]),
            'role' => $this->faker->randomElement(['Tank', 'Damage', 'Support']),
            'image' => function (array $attributes) {
                return '/chars/' . strtolower($attributes['name']) . '.jpg';
            },
        ];
    }
}
