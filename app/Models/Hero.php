<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Postable;

class Hero extends Model
{
    use HasFactory, Postable;

    protected $fillable = ['bio'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function path($append = 'index')
    {
        return route("hero.{$append}", [$this->id]);
    }

    // Check if auth user own the hero
    public function isOwned()
    {
        return auth()->user()->id === $this->id;
    }

    public function getAvatarAttribute()
    {
        return $this->user->profile_photo_url;
    }
    public function getNameAttribute()
    {
        return $this->user->name;
    }
    public function getUsernameAttribute()
    {
        return $this->user->username;
    }
}
