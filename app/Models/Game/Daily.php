<?php

namespace App\Models\Game;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Daily extends Model
{
    public const GAME_KEY_OVERWATCH = 'overwatch';
    public const GAME_KEY_OVERWATCH2 = 'overwatch2';
    public $fillable = [
        "game",
        "tile_1",
        "tile_2",
        "tile_3",
        "tile_4",
        "tile_5",
        "tile_6",
        "tile_7",
        "user_battlenet_id"
    ];

    /** Checks and returns gamemode if it has been set today
     * @param $game_key
     * @return Daily|false
     */
    public static function hasGamemodesSetToday($game_key)
    {
        $today = Daily::where([
            ['created_at', '>=', Carbon::today('utc')],
            ['game', '=', $game_key]
            ])->orderBy('created_at', 'desc')->first();
        return $today ?: false;
    }

    /** Get last gamemode set
     * @param $game_key
     * @return mixed
     */
    public static function getLastGamemode($game_key)
    {
        return Daily::where('game', $game_key)->orderBy('created_at', 'desc')->first();
    }


    /* Relationships */
    /* ---------------------------- */

    public function get_tile_1()
    {
        return $this->hasOne('App\Models\Game\Gamemode', 'id', 'tile_1');
    }

    public function get_tile_2()
    {
        return $this->hasOne('App\Models\Game\Gamemode', 'id', 'tile_2');
    }

    public function get_tile_3()
    {
        return $this->hasOne('App\Models\Game\Gamemode', 'id', 'tile_3');
    }

    public function get_tile_4()
    {
        return $this->hasOne('App\Models\Game\Gamemode', 'id', 'tile_4');
    }

    public function get_tile_5()
    {
        return $this->hasOne('App\Models\Game\Gamemode', 'id', 'tile_5');
    }

    public function get_tile_6()
    {
        return $this->hasOne('App\Models\Game\Gamemode', 'id', 'tile_6');
    }

    public function get_tile_7()
    {
        return $this->hasOne('App\Models\Game\Gamemode', 'id', 'tile_7');
    }

    public function get_user()
    {
        return $this->hasOne('App\Models\User', 'battlenet_id', 'user_battlenet_id');
    }
}
