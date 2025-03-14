<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class CharacterController extends Controller
{
    /**
     * Выбирает случайного персонажа по заданной роли с учётом пользовательских настроек (отключённых персонажей).
     */
    public function randomByRole(Request $request)
    {
        $role = $request->query('role');
        $validRoles = ['Tank', 'Damage', 'Support'];

        if (!$role || !in_array($role, $validRoles)) {
            return response()->json(['error' => 'Invalid role'], 400);
        }

        // Получаем всех персонажей для заданной роли (без фильтрации по глобальному состоянию)
        $characters = Character::where('role', $role)->get();

        // Фильтруем отключённых персонажей, которые пользователь установил в сессии
        $disabledKey = 'disabled_characters_' . $role;
        $disabled = session()->get($disabledKey, []);

        $characters = $characters->filter(function ($character) use ($disabled) {
            return !in_array($character->id, $disabled);
        });

        if ($characters->isEmpty()) {
            return response()->json(['error' => 'No characters available for this role.'], 404);
        }

        // Получаем историю последних выборов для заданной роли из сессии
        $lastPicked = $this->getLastPicked($role, $characters->count());

        // Генерируем веса для персонажей (чтобы недавно выбранные выпадали с меньшей вероятностью)
        $weights = $this->generateWeights($characters, $lastPicked);

        // Выбираем случайного персонажа с учетом весов
        $randomCharacter = $this->weightedRandom($characters, $weights, $request);

        // Обновляем историю последних выборов
        $this->updateLastPicked($role, $randomCharacter->id, $characters->count());

        // Отслеживаем статистику выпадений для режима разработчика
        $devData = $this->trackDeveloperData($role, $randomCharacter->id, $request);

        return response()->json([
            'name'      => $randomCharacter->name,
            'image'     => asset('chars/' . Str::slug($randomCharacter->name) . '.jpg'),
            'developer' => $devData,
        ]);
    }

    /**
     * Получает историю последних выборов для заданной роли из сессии.
     */
    private function getLastPicked(string $role, int $characterCount)
    {
        $key = 'last_picked_' . $role;
        $maxRecent = min(Config::get('overwatch.history.max_recent', 3), $characterCount - 1);
        return session()->get($key, []);
    }

    /**
     * Обновляет историю последних выборов для заданной роли в сессии.
     */
    private function updateLastPicked(string $role, int $characterId, int $characterCount)
    {
        $key = 'last_picked_' . $role;
        $maxRecent = min(Config::get('overwatch.history.max_recent', 3), $characterCount - 1);
        $lastPicked = session()->get($key, []);
        $lastPicked[] = $characterId;
        $lastPicked = array_unique($lastPicked);
        if (count($lastPicked) > $maxRecent) {
            $lastPicked = array_slice($lastPicked, -$maxRecent);
        }
        session()->put($key, $lastPicked);
    }

    /**
     * Генерирует веса для персонажей с учётом истории последних выборов.
     */
    private function generateWeights($characters, $lastPicked)
    {
        $defaultWeight = Config::get('overwatch.weights.default', 5);
        $recentWeight = Config::get('overwatch.weights.recent', 1);

        $weights = [];
        foreach ($characters as $character) {
            $weights[$character->id] = in_array($character->id, $lastPicked) ? $recentWeight : $defaultWeight;
        }
        return $weights;
    }

    /**
     * Выбирает случайного персонажа с учётом весов.
     */
    private function weightedRandom($characters, $weights, Request $request)
    {
        if (Config::get('overwatch.developer_mode', false) && $request->has('seed')) {
            srand($request->query('seed'));
        } else {
            srand();
        }

        $totalWeight = array_sum($weights);
        $rand = rand(1, $totalWeight);
        $cumulative = 0;
        foreach ($characters as $character) {
            $cumulative += $weights[$character->id];
            if ($rand <= $cumulative) {
                return $character;
            }
        }
        return $characters->last();
    }

    /**
     * Отслеживает статистику выпадений персонажей для режима разработчика.
     */
    private function trackDeveloperData(string $role, int $characterId, Request $request)
    {
        if (!Config::get('overwatch.developer_mode', false)) {
            return null;
        }
        $key = 'dev_distribution_' . $role;
        $distribution = session()->get($key, []);
        if (!isset($distribution[$characterId])) {
            $distribution[$characterId] = 0;
        }
        $distribution[$characterId]++;
        session()->put($key, $distribution);
        return [
            'seed'         => $request->query('seed', null),
            'distribution' => $distribution,
            'last_picked'  => session()->get('last_picked_' . $role, []),
        ];
    }

    /**
     * (Опционально) Метод для отключения персонажа в пуле для текущей сессии.
     * Можно вызывать этот метод через AJAX для обновления настроек пользователя.
     */
    public function disableCharacter(Request $request)
    {
        $role = $request->query('role');
        $characterId = $request->query('character_id');
        $validRoles = ['Tank', 'Damage', 'Support'];

        if (!$role || !in_array($role, $validRoles) || !$characterId) {
            return response()->json(['error' => 'Invalid parameters'], 400);
        }

        $disabledKey = 'disabled_characters_' . $role;
        $disabled = session()->get($disabledKey, []);

        if (!in_array($characterId, $disabled)) {
            $disabled[] = $characterId;
            session()->put($disabledKey, $disabled);
        }

        return response()->json(['success' => true, 'disabled' => $disabled]);
    }
}
