<?php

namespace App\Http\Resources\Overwatch;

use App\Models\Config;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyOverwatchResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /* @var $config \App\Models\Config */
        $config = Config::where('key', Config::KEY_LABEL_OVERWATCH)->firstOrFail();
        $created_at = Carbon::parse($this->created_at)->setTimezone('UTC');

        return [
            'created_at' => $created_at->toIso8601String(),
            'is_today' => $created_at->isToday(),
            'user' => [
                'battletag' => $this->get_user->name,
                'avatar' => $this->get_user->avatar
            ],
            'modes' => [
                "tile_1" => [
                    "image" => $this->get_tile_1->getTileImage(),
                    "name" => $this->get_tile_1->name,
                    "players" => $this->get_tile_1->players,
                    "label" => $config->getTileLabel("tile_1")
                ],
                "tile_2" => [
                    "image" => $this->get_tile_2->getTileImage(),
                    "name" => $this->get_tile_2->name,
                    "players" => $this->get_tile_2->players,
                    "label" => $config->getTileLabel("tile_2")
                ],
                "tile_3" => [
                    "image" => $this->get_tile_3->getTileImage(),
                    "name" => $this->get_tile_3->name,
                    "players" => $this->get_tile_3->players,
                    "label" => $config->getTileLabel("tile_3")
                ],
                "tile_4" => [
                    "image" => $this->get_tile_4->getTileImage(),
                    "name" => $this->get_tile_4->name,
                    "players" => $this->get_tile_4->players,
                    "label" => $config->getTileLabel("tile_4")
                ],
                "tile_5" => [
                    "image" => $this->get_tile_5->getTileImage(),
                    "name" => $this->get_tile_5->name,
                    "players" => $this->get_tile_5->players,
                    "label" => $config->getTileLabel("tile_5")
                ],
                "tile_6" => [
                    "image" => $this->get_tile_6->getTileImage(),
                    "name" => $this->get_tile_6->name,
                    "players" => $this->get_tile_6->players,
                    "label" => $config->getTileLabel("tile_6")
                ],
                "tile_7" => [
                    "image" => $this->get_tile_7->getTileImage(),
                    "name" => $this->get_tile_7->name,
                    "players" => $this->get_tile_7->players,
                    "label" => $config->getTileLabel("tile_7")
                ],
            ]
        ];
    }
}
