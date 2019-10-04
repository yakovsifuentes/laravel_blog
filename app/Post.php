<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $fillable = ['user_id', 'comment','media_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
