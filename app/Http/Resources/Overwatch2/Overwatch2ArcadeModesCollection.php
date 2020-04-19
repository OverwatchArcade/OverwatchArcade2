<?php

namespace App\Http\Resources\Overwatch2;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Overwatch2ArcadeModesCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = 'App\Http\Resources\Overwatch2\Overwatch2ArcadeModesResource';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
