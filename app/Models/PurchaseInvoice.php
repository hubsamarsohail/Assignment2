<?php

namespace App\Models;

use App\PurchaseItem;
use App\Traits\Usesuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseInvoice extends Model
{
    //
    use Usesuid;


    protected $fillable = ['supplier_id', 'supplier_account', 'invoice_num', 'invoice_date', 'truck_num', 'warehouse_id', 'vat_num', 'status', 'paid_at', 'total','sub_total','vat_amount'];
    protected $with = ['items'];
    public function uuidField()
    {
        return 'invoice_id';
    }

    protected $casts = [
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

    public function items()
    {
        return $this->hasMany(PurchaseItem::class,'invoice_id');
    }

    protected static function boot(){
        parent::boot();
        static::deleting(function($invoice){
            $invoice->items()->delete();
        });
    }
}
