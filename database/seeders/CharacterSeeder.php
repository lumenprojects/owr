<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Character;

class CharacterSeeder extends Seeder
{
    /**
     * Запустите сидер.
     *
     * @return void
     */
    public function run()
    {
        // Список всех персонажей Overwatch с их ролями и изображениями
        $characters = [
            // Tank
            ['name' => 'Doomfist', 'role' => 'Tank', 'image' => 'doomfist.jpg'],
            ['name' => 'D.Va', 'role' => 'Tank', 'image' => 'dva.jpg'],
            ['name' => 'Winston', 'role' => 'Tank', 'image' => 'winston.jpg'],
            ['name' => 'Reinhardt', 'role' => 'Tank', 'image' => 'rein.jpg'],
            ['name' => 'Hammond', 'role' => 'Tank', 'image' => 'hammond.jpg'],
            ['name' => 'Mauga', 'role' => 'Tank', 'image' => 'mauga.jpg'],
            // Damage
            ['name' => 'Junkrat', 'role' => 'Damage', 'image' => 'junkrat.jpg'],
            ['name' => 'Symmetra', 'role' => 'Damage', 'image' => 'symmetra.jpg'],
            ['name' => 'Tracer', 'role' => 'Damage', 'image' => 'tracer.jpg'],
            ['name' => 'Venture', 'role' => 'Damage', 'image' => 'venture.jpg'],
            // Support
            ['name' => 'Mercy', 'role' => 'Support', 'image' => 'mercy.jpg'],
            ['name' => 'Lucio', 'role' => 'Support', 'image' => 'lucio.jpg'],
            ['name' => 'Ana', 'role' => 'Support', 'image' => 'ana.jpg'],
            ['name' => 'Moira', 'role' => 'Support', 'image' => 'moira.jpg'],
            ['name' => 'Zenyatta', 'role' => 'Support', 'image' => 'zenyatta.jpg'],
            ['name' => 'Brigitte', 'role' => 'Support', 'image' => 'brigitte.jpg'],
            ['name' => 'Illari', 'role' => 'Support', 'image' => 'illari.jpg'],
        ];

        // Добавляем каждого персонажа в базу данных
        foreach ($characters as $character) {
            Character::create([
                'name' => $character['name'],
                'role' => $character['role'],
                'image' => $character['image'],
            ]);
        }
    }
}
