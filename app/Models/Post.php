<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\Traits\Commentable;

class Post extends Model
{
    use HasFactory, Commentable;

    protected $fillable= ['title','body','user_id','image'];
    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPostImageAttribute()
    {
        return 'http://127.0.0.1:8000/storage/'. $this->image;
    }
}
