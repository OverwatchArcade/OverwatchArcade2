<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class Gamemode extends Model
{
    public $timestamps = false;
    public const IMAGE_FOLDER = "/img/gamemodes/";

    /**
     * Returns image URL or 404 image tile URL if image does not exist
     * @return string
     */
    public function getTileImage()
    {
        $image = 'img/gamemodes/' . strtoupper(md5($this->name . $this->players)) . ".jpg";
        if (File::exists($image)) {
            return URL::asset($image);
        } else {
            return URL::asset('img/gamemodes/404.jpg');
        }
    }
}
