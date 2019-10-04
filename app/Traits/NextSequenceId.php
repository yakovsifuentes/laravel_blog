<?php // GetNextSequenceValue.php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait NextSequenceId
{
    public static function getNextSequenceId()
    {
        $self = new static();

        if (!$self->getIncrementing()) {
            throw new \Exception(sprintf('Model (%s) is not auto-incremented', static::class));
        }

        return DB::table($self->getTable())->max('id') +1;
    }
}