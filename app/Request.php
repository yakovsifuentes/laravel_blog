<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    public $table = ['request_friendly'];

    public $fillable = ['request_user_id', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}