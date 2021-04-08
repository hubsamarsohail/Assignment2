<?php

namespace App\Http\Controllers;

use App\Interfaces\InvoiceRepositoryInterface;
use App\Models\SalesReceipt;
use Illuminate\Http\Request;
use NumberFormatter;

class PrintController extends Controller
{
    public $invoiceRepo;

    public function __construct(InvoiceRepositoryInterface $invoiceRepo)
    {
        $this->invoiceRepo = $invoiceRepo;
    }

    public function purchaseInvoice(Request $request)
    {
        $formatter = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
        $formatter->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-numbering-verbose");
        $purchaseInvoice = $this->invoiceRepo->findPurchaseInvoiceByID($request->invoice_id);
        return view('print.purchase-invoice', compact('purchaseInvoice','formatter'));
    }

    public function salesInvoice(Request $request)
    {
        $salesInvoice = $this->invoiceRepo->findSalesInvoiceByID($request->invoice_id);

        $formatter = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
        $formatter->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-numbering-verbose");

        if ($request->has('generate_receipt')) {
            $salesInvoice->status = 'paid';
            $salesInvoice->paid_at = now();
            $salesInvoice->save();
            // Generate Receipt and mark as paid;
            $receipt = SalesReceipt::create(['invoice_id' => $salesInvoice->invoice_id, 'amount' => $salesInvoice->total, 'customer_id' => $salesInvoice->customer_id, 'vat_amount' => $salesInvoice->vat_amount,'sub_total' => $salesInvoice->sub_total]);
            return view('print.receipt', compact('receipt', 'formatter'));
        } else {

            return view('print.sales-invoice', compact('salesInvoice', 'formatter'));
        }
    }

    public function printReceipt(Request $request)
    {
        $receipt = $this->invoiceRepo->findSalesReceiptByID($request->invoice_id);

        $formatter = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
        $formatter->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-numbering-verbose");
        // Generate Receipt and mark as paid;
        // $receipt = SalesReceipt::create(['invoice_id' => $receipt->customer->invoice_id, 'amount' => $receipt->customer->total, 'customer_id' => $receipt->customer->id]);
        return view('print.receipt', compact('receipt', 'formatter'));
    }
}
