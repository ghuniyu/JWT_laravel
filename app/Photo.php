<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['path','user_id'];

    public function likes()
    {
        return $this->belongsToMany(User::class,'likes');
    }
}
