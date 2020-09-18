<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Likable;

class Comment extends Model
{
    use HasFactory, likable;
    protected $fillable= ['body', 'user_id'];
    protected $with = ['user'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getlikesCountAttribute()
    {
        $likes = $this->likes()->where('liked', true)->with('like')->count();
        $dislikes = $this->likes()->where('liked', false)->with('like')->count();
        return $likes - $dislikes;
    }
}
