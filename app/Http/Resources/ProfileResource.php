<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public static $wrap = 'profile';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'username' => $this->username,
            'bio' => $this->bio,
            'image' => $this->image,
            'following' => false
        ];
        return parent::toArray($request);
    }
}
