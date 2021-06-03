<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // public function followers()
    // {
    //     return $this->belongsToMany($this::class, 'followers', 'user_id', 'follower_id');
    // }

    // public function followings()
    // {
    //     return $this->belongsToMany($this::class, 'followers', 'follower_id', 'user_id');
    // }

    public function isFollowing(User $user)
    {
        $this->setTable("followers");
        return $this::where('user_id', '=', $user->id)
            ->where('follower_id', '=', $this->id)
            ->first();
    }

    public function favorites()
    {
        return $this->belongsToMany(Article::class, 'favoriters')->withTimestamps();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
