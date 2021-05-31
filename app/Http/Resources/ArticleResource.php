<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public static $wrap = 'article';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'description' => $this->description,
            'author' => new ProfileResource($this->user),
            'tagList' => $this->tags->map(fn ($tag) => $tag['name']),
            'favorited' => $this->isFavorited(),
            'favoritesCount' => 0,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
