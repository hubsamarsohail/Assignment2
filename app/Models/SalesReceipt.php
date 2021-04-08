<?php

namespace App\Models;

use App\Traits\Usesuid;
use Illuminate\Database\Eloquent\Model;

class SalesReceipt extends Model
{
    //
    use Usesuid;
    protected $fillable = ['invoice_id', 'receipt_id', 'amount', 'customer_id'];

    public function invoice()
    {
        return $this->belongsTo(SalesInvoice::class, 'invoice_id', 'invoice_id');
    }
    public function uuidField()
    {
        return 'receipt_id';
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
