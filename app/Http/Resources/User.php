<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Giph as GiphResource;

class User extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'avatar_giphy_id' => $this->avatar_giphy_id,
            'profile_url' => $this->profile_url,
            'handle' => $this->handle,
            'giphs' => GiphResource::collection($this->whenLoaded('giphs'))
        ];
    }
}
