<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = 'user';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'email' => $this->email,
            'username' => $this->username,
            'bio' => $this->bio,
            'image' => $this->image,
            'token' => auth('api')->login(\App\Models\User::find($this->id))
        ];
        return parent::toArray($request);
    }
}
