<?php

namespace App\Models;

use App\Traits\Usesuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseDeliveryNotice extends Model
{
    use Usesuid, SoftDeletes;

    protected $fillable = ['supplier_id', 'supplier_account', 'invoice_num', 'invoice_date', 'truck_num', 'warehouse_id', 'vat_num', 'items'];
    //

    public function uuidField()
    {
        return 'invoice_id';
    }

    protected $casts = [
        'items' => 'array',
        'invoice_date' => 'datetime'
    ];

    public function supplier()
    {
        return $this->belongsTo(Customer::class, 'supplier_id', 'id');
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
