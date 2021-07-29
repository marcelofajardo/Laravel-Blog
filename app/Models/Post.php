<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Commentable;
use App\Traits\Likable;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;
    use Commentable;
    use Likable;

    protected $fillable = ['body', 'image', 'user_id'];
    protected $with = ['comments'];

    /**
     * Get the parent postable model
     */
    public function postable()
    {
        return $this->morphTo();
    }

    /**
     * Post route path
     */
    public function path($append = "index")
    {
        return route("posts.$append", $this->id);
    }

    public function getPostImageAttribute()
    {
        return 'http://127.0.0.1:8000/storage/' . $this->image;
    }

    public function getCreatedAtAttribute()
    {
        $createdAt = $this->attributes['created_at'];
        return Carbon::parse($createdAt)->diffForHumans();
    }
}
