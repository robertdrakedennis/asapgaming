<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Article extends JsonResource
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
            'image' => env('APP_URL') . Storage::url($this->image),
            'title' => $this->title,
            'body' => $this->plaintext,
            'created_at' => $this->created_at->timestamp,
            'updated_at' => $this->updated_at->timestamp
        ];
    }
}
