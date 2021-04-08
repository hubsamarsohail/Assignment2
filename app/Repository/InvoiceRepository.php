<?php

namespace App\Repository;

use App\Interfaces\InvoiceRepositoryInterface;
use App\Models\Customer;
use App\Models\PurchaseDeliveryNotice;
use App\Models\SalesInvoice;
use App\Models\PurchaseInvoice;
use App\Models\SalesDeliveryNotice;
use App\Models\SalesReceipt;
use Illuminate\Support\Arr;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function computeVat($items)
    {
        $vat = 0;
        $productRepo = new ProductRepository();
        foreach ($items as $item) {
            $product_name = $item['product_name'];
            if($productRepo->isUnderVat($product_name)) {
                $vat += ( (float)$item['amount'] -  $item['sub_total']);
            }
        }
        return $vat;
    }

    public function addSalesInvoice($data)
    {
        return SalesInvoice::create($data);
    }

    public function addPurchaseInvoice($data)
    {
        return PurchaseInvoice::create($data);
    }


    public function allSalesInvoices($limit = 10)
    {
        if($limit == 10){
            // return SalesInvoice::paginate(10);
        }else{
            // return SalesInvoice::all();
        }
    }

    public function allUnpaidSalesInvoices()
    {
        return SalesInvoice::where('status', 'unpaid')->where('paid_at', null)->latest()->paginate(10);
    }

    public function allPaidSalesInvoices()
    {
        return SalesInvoice::where('status', 'paid')->where('paid_at', '!=', null)->latest()->paginate(10);
    }

    public function allUnpaidPurchaseInvoices()
    {
        return PurchaseInvoice::where('status', 'unpaid')->where('paid_at', null)->latest()->paginate(10);
    }

    public function allPaidPurchaseInvoices()
    {
        return PurchaseInvoice::where('status', 'paid')->where('paid_at', '!=', null)->latest()->paginate(10);
    }


    public function findSalesReceiptByID($invoice_id)
    {
        return SalesReceipt::with('invoice')->where('invoice_id', $invoice_id)->first();
    }

    public function allPaymentReceipt()
    {
        return SalesReceipt::latest()->paginate(10);
    }

    public function deleteSalesInvoice($invoice_id)
    {
    }

    public function deletePurchaseInvoice($invoice_id)
    {
    }

    public function findSalesInvoiceByID($invoice_id)
    {
        return SalesInvoice::where('invoice_id', $invoice_id)->first();
    }

    public function findPurchaseNoticeByID($invoice_id)
    {
        return PurchaseDeliveryNotice::where('invoice_id', $invoice_id)->first();
    }

    public function findSalesNoticeByID($invoice_id)
    {
        return SalesDeliveryNotice::where('invoice_id', $invoice_id)->first();
    }

    public function findPurchaseInvoiceByID($invoice_id)
    {
        return PurchaseInvoice::where('invoice_id', $invoice_id)->first();
    }

    public function restoreInvoice($invoice_id)
    {
    }

    public function updateInvoice($invoice_id, $data)
    {
    }

    public function allPurchaseInvoices($limit = 10)
    {
        if($limit == 10){
            return PurchaseInvoice::paginate(10);
        }else{
            return PurchaseInvoice::all();
        }
    }

    public function salesReport($customer_id,   $invoiceDate   , $invoiceDate2)
    {
        $report = SalesInvoice::query();
        

        
        
        if ($customer_id && $customer_id !== null) {
            $report = $report->where('customer_id', $customer_id);
        }
        
        
        if ($invoiceDate != "" && $invoiceDate2 != "") {

            $report = $report->whereBetween('invoice_date', [$invoiceDate, $invoiceDate2]);

        }

        $res = $report->get()->flatMap(function ($invoice) {
            return $invoice->items;

            
        });

     
        return $res;
    }

    public function purchaseReport($supplier_id, $date)
    {
        $report = PurchaseInvoice::query();

        // dd($data->supplier_id);
        if ($supplier_id && $supplier_id !== null) {
            $report = $report->where('supplier_id', $supplier_id);
        }

        if ($date && $date !== null) {
            $report = $report->where('date', $date);
        }


        $res = $report->get()->flatMap(function ($invoice) {
            return $invoice->items;
        });


        return $res;
    }

    public function addSalesDeliveryNotice($data)
    {
        return SalesDeliveryNotice::create($data);
    }

    public function addPurchaseDeliveryNotice($data)
    {
        return PurchaseDeliveryNotice::create($data);
    }

    public function salesDeliveryNotice()
    {
        return SalesDeliveryNotice::paginate(10);
    }

    public function purchaseDeliveryNotice()
    {
        return PurchaseDeliveryNotice::paginate(10);
    }

    public function markInvoiceAsUnpaid($invoice_id)
    {
        $invoice = $this->findSalesInvoiceByID($invoice_id);
        $invoice->status = "unpaid";
        $invoice->paid_at = null;
        if ($invoice->save()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function deleteInvoice($invoice_id, $type = "")
    {
        if ($type == "") {
            $invoice = $this->findSalesInvoiceByID($invoice_id);
        } else {
            $invoice = $this->findPurchaseInvoiceByID($invoice_id);
        }
        // dd($type);
        // dd($invoice);
        if ($invoice->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
