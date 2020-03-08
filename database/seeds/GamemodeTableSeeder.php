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

        $json = File::get('database/data/overwatch/arcademodes.json');
        foreach(json_decode($json, true) as $mode){
            $gamemode = new Gamemode();
            $gamemode->name = $mode['title'];
            $gamemode->players = $mode['players'];
            $gamemode->game = Daily::GAME_KEY_OVERWATCH;
            $gamemode->save();
        }
    }
}
