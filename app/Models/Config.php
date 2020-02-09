<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    const KEY_LABEL_OVERWATCH = "overwatch_label";
    const KEY_OVERWATCH_CHARACTERS = "overwatch_characters";
    const KEY_OVERWATCH_MAPS = "overwatch_maps";

    const KEY_LABEL_OVERWATCH2 = "overwatch2_label";

    const KEY_COUNTRIES = "countries";


    public $fillable = ['key', 'value'];
    protected $casts = [
        'value' => 'array',
    ];

    public function getTileLabel($tile)
    {
        if (isset($this->value[$tile])) {
            return $this->value[$tile];
        }
        return null;
    }
}
