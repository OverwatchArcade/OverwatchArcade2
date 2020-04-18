<?php

namespace App\Http\Controllers;

use App\Http\Requests\Overwatch2ArcadeModeSubmit;
use App\Http\Requests\OverwatchArcadeModeSubmit;
use App\Http\Requests\ProfileUpdate;
use App\Jobs\OverwatchTwitterPost;
use App\Models\Config;
use App\Models\Game\Daily;
use App\Models\Logs;
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
    public function overwatch_submit_index()
    {
        return view('admin.overwatch.submit');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function overwatch2_submit_index()
    {
        return view('admin.overwatch2.submit');
    }

    /**v
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settings()
    {
        return view('settings');
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAvatars()
    {
        return response()->json(Config::getAvatars());
    }

    /**
     * @param ArcadeModePost $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function submitOverwatchTodaysArcade(OverwatchArcadeModeSubmit $request)
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
            OverwatchTwitterPost::dispatch();
        }

        return response()->json($request->all());
    }

    /**
     * @param ArcadeModePost $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function submitOverwatch2TodaysArcade(Overwatch2ArcadeModeSubmit $request)
    {
        if (Daily::hasGamemodesSetToday(Daily::GAME_KEY_OVERWATCH2)) {
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
            'game' => Daily::GAME_KEY_OVERWATCH2
        ]);

        if (env('APP_ENV') == "Production") {
            OverwatchTwitterPost::dispatch();
        }

        return response()->json($request->all());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUserProfile(ProfileUpdate $request)
    {
        $user = Auth::user();
        $user->profile_data = $request->only([
            'game.map',
            'game.mode',
            'game.character',
            'profile.country',
            'profile.about'
        ]);

        if ($request->has('profile.avatar')) {
            $user->avatar = $request->get('profile')['avatar'];
        }

        $user->save();
        return response()->json('success');
    }

    public function undoOverwatchTodaysArcade(Request $request)
    {
        $daily = Daily::hasGamemodesSetToday(Daily::GAME_KEY_OVERWATCH);
        if ($daily) {
            Logs::create([
                'type' => Logs::UNDO_SUBMIT_OW,
                'payload' => $daily->attributesToArray(),
                'user_battlenet_id' => Auth::user()->id
            ]);
            $daily->delete();
            return response()->json(['status' => 'success', 'message' => 'Daily deleted succesfully']);
        }
        return response()->json(['status' => 'failed', 'message' => 'Daily not found']);
    }

    public function undoOverwatch2TodaysArcade(Request $request)
    {
        $daily = Daily::hasGamemodesSetToday(Daily::GAME_KEY_OVERWATCH2);
        if ($daily) {
            Logs::create([
                'type' => Logs::UNDO_SUBMIT_OW2,
                'payload' => $daily->attributesToArray(),
                'user_battlenet_id' => Auth::user()->id
            ]);
            $daily->delete();
            return response()->json(['status' => 'success', 'message' => 'Daily deleted succesfully']);
        }
        return response()->json(['status' => 'failed', 'message' => 'Daily not found']);
    }
}
