<?php

namespace App;

use App\Traits\NextSequenceId;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use NextSequenceId;

    protected $fillable = [
        'type',
        'name',
        'extension',
        'size',
        'mime_type',
        'path',
        'status'
        ];
}
