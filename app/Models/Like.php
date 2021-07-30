<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable= ['user_id', 'liked'];

    protected $table = 'likes';

    /**
     * Get the parent likable model
     */
    public function likable()
    {
        return $this->morphTo();

    }
}
