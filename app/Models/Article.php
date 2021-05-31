<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    use Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favoriters()
    {
        return $this->belongsToMany(User::class, 'favoriters')->withTimestamps();
    }

    public function isFavorited()
    {
        if (!auth('api')->check()) {
            return false;
        }

        self::setTable('favoriters');

        return self::where('user_id', '=', auth('api')->id())
            ->where('article_id', '=', $this->id)
            ->count() > 0
            ? true
            : false;
    }
}
