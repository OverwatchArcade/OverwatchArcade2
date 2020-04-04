<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Overwatch2\DailyOverwatch2Resource;
use App\Http\Resources\Overwatch2\Overwatch2ArcadeModesCollection;
use App\Models\Game\Daily;
use App\Models\Game\Gamemode;
use Illuminate\Http\Request;

class Overwatch2ApiController extends Controller
{
    /**
     * Return daily in json format or empty array if no modes have been set unless fallback is given as paramater
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function today(Request $request)
    {
        $response = new DailyOverwatch2Resource(Daily::getLastGamemode(Daily::GAME_KEY_OVERWATCH2));
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Returns all gamemodes (name, players)
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function gamemodes(Request $request)
    {
        return response()->json(new Overwatch2ArcadeModesCollection(Gamemode::where('game',
            Daily::GAME_KEY_OVERWATCH2)->get()), 200, [], JSON_PRETTY_PRINT);
    }

}
