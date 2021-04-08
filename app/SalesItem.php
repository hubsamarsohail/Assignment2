<?php

namespace App;

use App\Models\SalesInvoice;
use Illuminate\Database\Eloquent\Model;

class SalesItem extends Model
{
     //
     protected $fillable = ['product_name', 'compartment', 'quantity_observed', 'coefficient', 'price_vat', 'quantity_15deg', 'invoice_date', 'price', 'amount','invoice_id','sub_total', 'currency'];

     protected $cast = ['invoice_date' => 'date'];

    public function invoice()
    {
        return $this->belongsTo(SalesInvoice::class,'invoice_id');
    }
}
