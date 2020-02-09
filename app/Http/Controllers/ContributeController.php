<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArcadeModePost;
use App\Jobs\TwitterPost;
use App\Models\Game\Daily;
use App\Models\Game\Gamemode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContributeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.overwatch.submit');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settings()
    {
        return view('settings');
    }

    /**
     * @param ArcadeModePost $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function submitTodaysArcade(ArcadeModePost $request)
    {
        if (Daily::hasGamemodesSetToday(Daily::GAME_KEY_OVERWATCH)) {
            return response('Gamemode has already been set', 409);
        }

        Daily::create([
            'tile_1' => $request->get('tile_1')['id'],
            'tile_2' => $request->get('tile_2')['id'],
            'tile_3' => $request->get('tile_3')['id'],
            'tile_4' => $request->get('tile_4')['id'],
            'tile_5' => $request->get('tile_5')['id'],
            'tile_6' => $request->get('tile_6')['id'],
            'tile_7' => $request->get('tile_7')['id'],
            'user_battlenet_id' => Auth::user()->battlenet_id,
            'game' => Daily::GAME_KEY_OVERWATCH
        ]);

        if (env('APP_ENV') == "Production") {
            TwitterPost::dispatch();
        }

        return response()->json($request->all());
    }
}
