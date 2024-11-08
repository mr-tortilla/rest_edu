<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['name'];

    public function authors(){
        return $this->hasMany(Author::class);
    }
}
