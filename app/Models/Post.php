<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\Traits\Commentable;

class Post extends Model
{
    use HasFactory, Commentable;

    protected $fillable= ['body','user_id','image'];

    public function postable()
    {
        return $this->morphTo();
    }

    public function path($append = "index")
    {
        return route("post.$append", $this->id);
    }

    public function getPostImageAttribute()
    {
        return 'http://127.0.0.1:8000/storage/'. $this->image;
    }
}
