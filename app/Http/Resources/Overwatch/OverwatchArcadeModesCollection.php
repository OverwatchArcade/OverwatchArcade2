<?php

namespace App\Http\Resources\Overwatch;

use Illuminate\Http\Resources\Json\ResourceCollection;


class OverwatchArcadeModesCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = 'App\Http\Resources\Overwatch\OverwatchArcadeModesResource';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
