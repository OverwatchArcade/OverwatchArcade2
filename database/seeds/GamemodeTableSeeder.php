<?php

use App\Models\Game\Daily;
use App\Models\Game\Gamemode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GamemodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gamemodes')->truncate();

        $json = File::get('resources/js/i18n/us.json');
        foreach(json_decode($json, true)['overwatch']['arcademodes'] as $key => $value){
            $gamemode = new Gamemode();
            $gamemode->name = $value['Name'];
            $gamemode->players = $value['Players'];
            $gamemode->game = Daily::GAME_KEY_OVERWATCH;
            $gamemode->save();
        }
    }
}
