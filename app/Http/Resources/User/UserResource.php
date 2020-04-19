<?php

namespace App\Http\Resources\User;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "name" => $this->name,
            "avatar" => $this->avatar,
            "contributions" => $this->getContributedDailies()->count(),
            "last_submit" => $this->getLastContributed(),
            "member_since" => Carbon::parse($this->created_at)->format("l, d M Y"),
            "profile_data" => $this->profile_data
        ];
    }
}
