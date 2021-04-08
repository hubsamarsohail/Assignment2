<?php

namespace App\Models;

use App\Model\Product;
use App\Traits\Usesuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use Usesuid, SoftDeletes;
    //

    protected $guarded = ['id'];

    public function uuidField()
    {
        return 'stock_id';
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity');
    }


    public function getRouteKeyName()
    {
        return 'stock_id';
    }
}
