<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdate;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserApiController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllUsers()
    {
        $users = User::all()->sortByDesc(function ($user) {
            return $user->getContributedDailies->count();
        })->filter(function ($user) {
            return Carbon::parse($user->getLastContributed(), 'utc') >= Carbon::now('utc')->subMonths(3);
        });
        return response()->json(new UserCollection($users), 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * @param Request $request
     * @param $battletag
     */
    public function getUserProfile(Request $request, $battletag)
    {
        $user = User::where('name', $battletag)->firstOrFail();
        return response()->json(new UserResource($user), 200, [], JSON_PRETTY_PRINT);
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

}
