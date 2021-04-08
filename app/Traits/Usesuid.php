<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Usesuid
{

    public function uuidField()
    {
        return 'uuid';
    }
    protected static function bootUsesUid()
    {

        static::creating(function ($model) {
            $model[$model->uuidField() ?? 'uuid'] = (string) Str::uuid();
        });
    }
}
