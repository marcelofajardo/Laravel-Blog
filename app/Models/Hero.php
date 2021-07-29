<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use App\Traits\Postable;

class Hero extends Model
{
    use HasFactory, Postable;

    protected $fillable = ['bio'];

    /**
     * Get the hero's user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * User route path
     */
    public function path($append = 'index')
    {
        return route("heroes.{$append}", [$this->id]);
    }

    /**
     * Check if user owned the hero.
     */
    public function isOwned()
    {
        return Auth::id() == $this->id;
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
