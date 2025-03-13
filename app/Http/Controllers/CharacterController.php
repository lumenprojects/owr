<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use Illuminate\Support\Facades\Cache;

class CharacterController extends Controller
{
    public function randomByRole(Request $request)
    {
        $role = $request->query('role');

        if (!$role || !in_array($role, ['Tank', 'Damage', 'Support'])) {
            return response()->json(['error' => 'Invalid role'], 400);
        }

        // Получаем всех персонажей данной роли
        $characters = Character::where('role', $role)->get();

        if ($characters->isEmpty()) {
            return response()->json(['error' => 'No characters found'], 404);
        }

        // Получаем последние 3 персонажа, которые выпадали
        $lastPicked = Cache::get('last_picked_' . $role, []);

        // Система весов (понижаем шанс выпадения недавно выбранных персонажей)
        $weightedCharacters = [];
        foreach ($characters as $character) {
            $weight = in_array($character->id, $lastPicked) ? 1 : 5; // Недавно выбранный — шанс 1, новый — шанс 5
            for ($i = 0; $i < $weight; $i++) {
                $weightedCharacters[] = $character;
            }
        }

        // Выбираем случайного персонажа
        $randomCharacter = $weightedCharacters[array_rand($weightedCharacters)];

        // Обновляем кэш (сохраняем 3 последних персонажа)
        $lastPicked[] = $randomCharacter->id;
        if (count($lastPicked) > 3) {
            array_shift($lastPicked);
        }
        Cache::put('last_picked_' . $role, $lastPicked, 600); // Кэшируем на 10 минут

        return response()->json([
            'name' => $randomCharacter->name,
            'image' => asset('chars/' . strtolower($randomCharacter->name) . '.jpg'),
        ]);
    }
}
