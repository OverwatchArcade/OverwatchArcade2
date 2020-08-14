<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Overwatch\DailyOverwatchResource;
use App\Http\Resources\Overwatch\OverwatchArcadeModesCollection;
use App\Models\Game\Daily;
use App\Models\Game\Gamemode;
use Illuminate\Http\Request;

class OverwatchApiController extends Controller
{
    /**
     * Return daily in json format
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function today(Request $request)
    {
        $response = new DailyOverwatchResource(Daily::getLastGamemode(Daily::GAME_KEY_OVERWATCH));
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Returns all gamemodes (name, players)
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function gamemodes(Request $request)
    {
        return response()->json(new OverwatchArcadeModesCollection(Gamemode::where('game',
            Daily::GAME_KEY_OVERWATCH)->get()), 200, [], JSON_PRETTY_PRINT);
    }

}
