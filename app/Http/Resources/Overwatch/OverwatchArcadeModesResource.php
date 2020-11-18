<?php

namespace App\Http\Resources\Overwatch;

use App\Models\Game\Gamemode;
use Illuminate\Http\Resources\Json\JsonResource;

class OverwatchArcadeModesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "players" => $this->players,
            "image" => env('APP_URL') . Gamemode::IMAGE_FOLDER . strtoupper(md5($this->name . $this->players)) . ".jpg"
        ];
    }
}
