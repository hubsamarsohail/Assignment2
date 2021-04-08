<?php

namespace App\Model;

use App\Models\Stock;
use App\Traits\Usesuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Usesuid, SoftDeletes;
    //

    protected $fillable = ['name', 'quantity', 'under_vat'];
    public function uuidField()
    {
        return 'product_id';
    }

    public function stocks()
    {
        return $this->belongsToMany(Stock::class)
            ->withPivot('quantity');
    }

    public function getrouteKeyName()
    {
        return 'product_id';
    }
}
