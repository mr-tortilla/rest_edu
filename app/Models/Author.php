<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name', 'channel_id'];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
