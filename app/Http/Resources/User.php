<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'steam_account_id' => $this->steam_account_id,
            'color' => $this->color,
            'avatar' => Storage::url($this->avatar),
            'background' => Storage::url($this->background),
            'about' => $this->plaintext,
            'slug' => $this->slug,
            'post_count' => $this->post_count,
            'credits' => $this->credits,
            'total_credits' => $this->total_credits,
            'donator_tier' => $this->donator_tier,
        ];
    }
}
