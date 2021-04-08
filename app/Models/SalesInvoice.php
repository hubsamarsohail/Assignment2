<?php

namespace App\Models;

use App\Repository\InvoiceRepository;
use App\Traits\Usesuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\SalesItem;

class SalesInvoice extends Model
{
    use Usesuid;
    protected $fillable = ['customer_id', 'customer_account', 'invoice_num', 'invoice_date', 'truck_num', 'warehouse_id', 'vat_num', 'status', 'paid_at', 'total'];

    protected $with = ['items'];
    
    public function uuidField()
    {
        return 'invoice_id';
    }

    protected $casts = [
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

    public function vat()
    {
        $invoiceRepo = new InvoiceRepository();
        return $invoiceRepo->computeVat($this->items);
    }

    public function receipt()
    {
        return $this->hasOne(SalesReceipt::class,'invoice_id','invoice_id');
    }


    public function items()
    {
        
        return $this->hasMany(SalesItem::class,'invoice_id');
    }

    protected static function boot(){
        parent::boot();
        static::deleting(function($invoice){
            $invoice->receipt()->delete();
            $invoice->items()->delete();
        });
    }
    
}
