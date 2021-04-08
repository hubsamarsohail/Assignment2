<?php

namespace App\Models;

use App\Traits\Usesuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesDeliveryNotice extends Model
{
    //
    use Usesuid, SoftDeletes;

    protected $fillable = ['customer_id', 'customer_account', 'invoice_num', 'invoice_date', 'truck_num', 'warehouse_id', 'vat_num', 'items'];
    //

    public function uuidField()
    {
        return 'invoice_id';
    }

    protected $casts = [
        'items' => 'array',
        'invoice_date' => 'datetime'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Stock::class, 'warehouse_id');
    }

    public function generateInvoice($price)
    {
        return '';
    }
}
