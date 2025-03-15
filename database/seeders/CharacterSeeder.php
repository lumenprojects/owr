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
            ['name' => 'Hazard', 'role' => 'Tank', 'image' => 'hazard.jpg'],
            ['name' => 'Junker Queen', 'role' => 'Tank', 'image' => 'junker_queen.jpg'],
            ['name' => 'Mauga', 'role' => 'Tank', 'image' => 'mauga.jpg'],
            ['name' => 'Orisa', 'role' => 'Tank', 'image' => 'orisa.jpg'],
            ['name' => 'Ramattra', 'role' => 'Tank', 'image' => 'ramattra.jpg'],
            ['name' => 'Reinhardt', 'role' => 'Tank', 'image' => 'reinhardt.jpg'],
            ['name' => 'Roadhog', 'role' => 'Tank', 'image' => 'roadhog.jpg'],
            ['name' => 'Sigma', 'role' => 'Tank', 'image' => 'sigma.jpg'],
            ['name' => 'Winston', 'role' => 'Tank', 'image' => 'winston.jpg'],
            ['name' => 'Wrecking Ball', 'role' => 'Tank', 'image' => 'wrecking_ball.jpg'],
            ['name' => 'Zarya', 'role' => 'Tank', 'image' => 'zarya.jpg'],

            // Damage
            ['name' => 'Ashe', 'role' => 'Damage', 'image' => 'ashe.jpg'],
            ['name' => 'Bastion', 'role' => 'Damage', 'image' => 'bastion.jpg'],
            ['name' => 'Cassidy', 'role' => 'Damage', 'image' => 'cassidy.jpg'],
            ['name' => 'Echo', 'role' => 'Damage', 'image' => 'echo.jpg'],
            ['name' => 'Genji', 'role' => 'Damage', 'image' => 'genji.jpg'],
            ['name' => 'Hanzo', 'role' => 'Damage', 'image' => 'hanzo.jpg'],
            ['name' => 'Junkrat', 'role' => 'Damage', 'image' => 'junkrat.jpg'],
            ['name' => 'Mei', 'role' => 'Damage', 'image' => 'mei.jpg'],
            ['name' => 'Pharah', 'role' => 'Damage', 'image' => 'pharah.jpg'],
            ['name' => 'Reaper', 'role' => 'Damage', 'image' => 'reaper.jpg'],
            ['name' => 'Sojourn', 'role' => 'Damage', 'image' => 'sojourn.jpg'],
            ['name' => 'Soldier: 76', 'role' => 'Damage', 'image' => 'soldier76.jpg'],
            ['name' => 'Sombra', 'role' => 'Damage', 'image' => 'sombra.jpg'],
            ['name' => 'Symmetra', 'role' => 'Damage', 'image' => 'symmetra.jpg'],
            ['name' => 'Torbjorn', 'role' => 'Damage', 'image' => 'torbjorn.jpg'],
            ['name' => 'Tracer', 'role' => 'Damage', 'image' => 'tracer.jpg'],
            ['name' => 'Venture', 'role' => 'Damage', 'image' => 'venture.jpg'],
            ['name' => 'Widowmaker', 'role' => 'Damage', 'image' => 'widowmaker.jpg'],

            // Support
            ['name' => 'Ana', 'role' => 'Support', 'image' => 'ana.jpg'],
            ['name' => 'Baptiste', 'role' => 'Support', 'image' => 'baptiste.jpg'],
            ['name' => 'Brigitte', 'role' => 'Support', 'image' => 'brigitte.jpg'],
            ['name' => 'Illari', 'role' => 'Support', 'image' => 'illari.jpg'],
            ['name' => 'Juno', 'role' => 'Support', 'image' => 'juno.jpg'],
            ['name' => 'Kiriko', 'role' => 'Support', 'image' => 'kiriko.jpg'],
            ['name' => 'Lifeweaver', 'role' => 'Support', 'image' => 'lifeweaver.jpg'],
            ['name' => 'Lucio', 'role' => 'Support', 'image' => 'lucio.jpg'],
            ['name' => 'Mercy', 'role' => 'Support', 'image' => 'mercy.jpg'],
            ['name' => 'Moira', 'role' => 'Support', 'image' => 'moira.jpg'],
            ['name' => 'Zenyatta', 'role' => 'Support', 'image' => 'zenyatta.jpg'],
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
