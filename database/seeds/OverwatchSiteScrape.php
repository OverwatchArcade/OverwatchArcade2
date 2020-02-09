<?php

use GuzzleHttp\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * Uses the database/data/overwatch/<file>.json data, scraped from the official OW website to download the images (map thumbnail, character portrait)
 * Class OverwatchSiteScrape
 */
class OverwatchSiteScrape extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();

        $characters = File::get('database/data/overwatch/characters.json');
        foreach(json_decode($characters, true) as $character){
            $file = $client->request('GET', $character['image']);
            Storage::disk('public')->put("img/characters/".str_replace([":", " "], "", $character['title']).".jpg", $file->getBody());
        }

        $maps = File::get('database/data/overwatch/maps.json');
        foreach(json_decode($maps, true) as $map){
            $file = $client->request('GET', $map['image']);
            Storage::disk('public')->put("img/maps/".str_replace(":", "", $map['title']).".jpg", $file->getBody());
        }
    }
}
