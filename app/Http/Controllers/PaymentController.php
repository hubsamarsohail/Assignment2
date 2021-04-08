<?php

namespace App\Http\Controllers;

use App\Interfaces\InvoiceRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public $invoiceRepo;


    public function __construct(InvoiceRepositoryInterface $invoiceRepo)
    {
        $this->invoiceRepo = $invoiceRepo;
    }

    public function sales(Request $request)
    {

        // date
        // serial num,
        // amount,
        // received from
        // address/tel
        // amount in words
        // details
        $sales_invoices_receipt = $this->invoiceRepo->allPaymentReceipt();
        // foreach ($sales_invoices_receipt as $receipt) {
            // dd($sales_invoices_receipt[2]->invoice->id);
        // }
        // dd('hi');
        // dump($sales_invoices_receipt->customer);
        return view('invoices.sales.payment', compact('sales_invoices_receipt'));
    }

    public function makeSales(Request $request)
    {
        dd($request);
    }
}
