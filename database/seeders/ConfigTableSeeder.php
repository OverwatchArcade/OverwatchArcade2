<?php
namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->truncate();


        /*
         *  OVERWATCH 1
         */

        Config::create([
            "key" => Config::KEY_LABEL_OVERWATCH,
            "value" => [
                "tile_1" => "Permanent",
                "tile_2" => "Daily",
                "tile_3" => "Weekly"
            ]
        ]);

        $overwatchMapdata = json_decode(File::get('database/data/overwatch/maps.json'), true);
        Config::create([
            "key" => Config::KEY_OVERWATCH_MAPS,
            "value" => array_column($overwatchMapdata, 'title')
        ]);

        $overwatchCharacterData = json_decode(File::get('database/data/overwatch/characters.json'), true);
        Config::create([
            "key" => Config::KEY_OVERWATCH_CHARACTERS,
            "value" => array_column($overwatchCharacterData, 'title')
        ]);


        /*
         *  OVERWATCH 2
         */

        Config::create([
            "key" => Config::KEY_LABEL_OVERWATCH2,
            "value" => [
                "tile_1" => "Permanent",
                "tile_2" => "Daily",
                "tile_3" => "Weekly"
            ]
        ]);

        /*
         *  GENERAL
         */

        Config::create([
            "key" => Config::KEY_COUNTRIES,
            "value" => json_decode(File::get('database/data/general/countries.json'), true)
        ]);

        Config::create([
           "key" => Config::KEY_WHITELISTED_UIDS,
           "value" => json_decode(File::get('database/data/general/whitelisted-ids.json'), true)
        ]);

    }
}
