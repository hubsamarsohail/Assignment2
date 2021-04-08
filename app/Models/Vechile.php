<?php

namespace App\Models;

use App\Traits\Usesuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vechile extends Model
{
    use SoftDeletes, Usesuid;
    //

    protected $guarded = ['id'];

    public function uuidField()
    {
        return 'vechile_id';
    }

    public function getRouteKeyName()
    {
        return 'vechile_id';
    }
}
