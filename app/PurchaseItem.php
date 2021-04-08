<?php

namespace App;

use App\Models\PurchaseInvoice;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    //
    protected $fillable = ['product_name', 'compartment', 'quantity_observed', 'coefficient', 'price_vat', 'quantity_15deg', 'invoice_date', 'price', 'amount','invoice_id','sub_total','currency'];

    protected $cast = ['invoice_date' => 'date'];

    public function invoice()
    {
        return $this->belongsTo(PurchaseInvoice::class,'invoice_id');
    }
}
