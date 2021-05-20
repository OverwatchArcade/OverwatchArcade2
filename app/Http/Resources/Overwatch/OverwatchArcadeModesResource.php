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
            "notice" => "WARNING - This API will be deprecated and change breaking soon. I'm rewriting everything. Keep an eye out for changes on https://github.com/OverwatchArcade.",
            "id" => $this->id,
            "name" => $this->name,
            "players" => $this->players,
            "image" => config('app.url') . Gamemode::IMAGE_FOLDER . strtoupper(md5($this->name . $this->players)) . ".jpg"
        ];
    }
}
