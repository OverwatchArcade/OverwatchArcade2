<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Config extends Model
{
    const KEY_LABEL_OVERWATCH = "overwatch_label";
    const KEY_OVERWATCH_CHARACTERS = "overwatch_characters";
    const KEY_OVERWATCH_MAPS = "overwatch_maps";

    const KEY_LABEL_OVERWATCH2 = "overwatch2_label";

    const KEY_COUNTRIES = "countries";
    const KEY_WHITELISTED_UIDS = "whitelisted_ids";

    public $fillable = ['key', 'value'];
    protected $casts = [
        'value' => 'array',
    ];


    /**
     * Gets the corresponding label (Daily, Weekly, Permanent) for a tile name
     * @param $tile
     * @return |null
     */
    public function getTileLabel($tile)
    {
        if (isset($this->value[$tile])) {
            return $this->value[$tile];
        }
        return null;
    }

    /**
     * Retrieves all available avatars from public folder
     * builds array with filename and path
     */
    public static function getAvatars()
    {
        $files = Storage::disk('public')->allFiles('img/avatars');
        $fileArray = [];
        foreach($files as $file){
            $fileArray[] = substr(strrchr($file, '/'), 1);
        }

        return $fileArray;
    }
}
