<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Likable;

class Comment extends Model
{
    use HasFactory;
    use likable;

    protected $fillable= ['body', 'user_id'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function path($append = "index")
    {
        return route("comment.$append", $this->id);
    }

    public function getlikesCountAttribute()
    {
        $likes = $this->likes()->where('liked', true)->count();
        $dislikes = $this->likes()->where('liked', false)->count();
        return $likes - $dislikes;
    }
}
