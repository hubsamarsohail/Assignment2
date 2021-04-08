<?php

namespace App\Models;

use App\Traits\Usesuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    //
    use SoftDeletes, Usesuid;
    protected $guarded = ['deleted_at', 'id'];

    public function purchaseInvoices()
    {
        return $this->hasMany(PurchaseInvoice::class, 'supplier_id');
    }


    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
