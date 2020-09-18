<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;

    protected $fillable = ['bio'];
    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAvatarAttribute()
    {
        return $this->user->profile_photo_url;
    }

    public function path($append = 'index')
    {
        return route("user.hero.{$append}", [$this->user->id, $this->id]);
    }
}
