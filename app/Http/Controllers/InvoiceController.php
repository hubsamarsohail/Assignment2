<?php

namespace App\Http\Controllers;

use App\Interfaces\CustomerRepositoryInterface;
use App\Interfaces\InvoiceRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\StockRepositoryInterface;
use App\Model\Product;
use App\SalesItem;
use App\PurchaseItem;
use App\Models\SalesInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class InvoiceController extends Controller
{
    //
    public $invoiceRepo;
    public $customerRepo;
    public $stockRepo;
    public $productRepo;
    public function __construct(
        InvoiceRepositoryInterface $invoiceRepo,
        CustomerRepositoryInterface $customerRepo,
        StockRepositoryInterface $stockRepo,
        ProductRepositoryInterface $productRepo
    ) {
        $this->invoiceRepo = $invoiceRepo;
        $this->customerRepo = $customerRepo;
        $this->stockRepo = $stockRepo;
        $this->productRepo = $productRepo;
    }


    public function purchaseInvoiceCreateForm(Request $request)
    {
        $suppliers = $this->customerRepo->allSuppliers();
        $purchase_invoices_unpaid = $this->invoiceRepo->allUnpaidPurchaseInvoices();
        $purchase_invoices_paid = $this->invoiceRepo->allPaidPurchaseInvoices();
        $stocks = $this->stockRepo->allStocks();
        $purchase_invoices = $this->invoiceRepo->allPurchaseInvoices();
        return view('invoices.purchase.index', compact(['suppliers', 'stocks', 'purchase_invoices_paid', 'purchase_invoices_unpaid']));
    }

    public function salesInvoiceCreateForm(Request $request)
    {
        $customers = $this->customerRepo->allCustomers();
        $sales_invoices_unpaid = $this->invoiceRepo->allUnpaidSalesInvoices();
        $sales_invoices_paid = $this->invoiceRepo->allPaidSalesInvoices();

        $stocks = $this->stockRepo->allStocks();
        $products = $this->productRepo->listProducts();
        return view('invoices.sales.index', compact(['customers', 'stocks', 'sales_invoices_unpaid', 'sales_invoices_paid', 'products']));
    }

    public function purchaseInvoiceStore(Request $request)
    {
        $total  = 0;
        $vat_amount = 0;
        //validate the request;
        // dd($request);
        $this->validate($request, [
            'supplier_id' => 'required',
            'supplier_account' => 'required',
            // 'invoice_num' => 'required',
            'invoice_date' => 'sometimes|date',
            'truck_num' => 'required',
            'warehouse_id' => 'required',
            // 'vat_num' => 'required',
            'items' => 'required'
        ]);


        
        $amt = json_decode($request->items);
        $val = array_reduce($amt, function ($item, $a) {
            return $a->amount + $item;
        }, 0);
        // $request->request->set('total', $val);
        
        $request->request->set('sub_total', $val);


        $request->request->set('supplier_account', explode(' - ', $request->supplier_account)[1]);

        $request->request->set('items', json_decode($request->items));


        foreach ($request->items as $item) {
            $item->sub_total = $item->amount;
            
            if($item->product_name == "Unleaded 95"){
                $item_vat = $item->amount * 0.11;
                $vat_amount += $item_vat;
                $total+= ($item->amount + $item_vat );
                $item->amount = ($item->sub_total + $item_vat );
            }
        }


        $request->request->set('total', $val);
        $request->request->set('vat_amount', $vat_amount);
        
        $purchaseInvoice = $this->invoiceRepo->addPurchaseInvoice($request->except('items'));
        foreach ($request->items as $item) {
            # code...
            // $purchaseInvoice->items()->save($item);

            $sale_item = PurchaseItem::create([
                'product_name' => $item->product_name,
                'compartment' => $item->compartment,
                'quantity_observed' => $item->quantity_observed,
                'coefficient' => $item->coefficient,
                'price_vat' => $item->price_vat ?$item->price_vat: 0,
                'quantity_15deg' => $item->quantity_15deg,
                'invoice_date' => $item->invoice_date,
                'price' => $item->price,
                'amount' => $item->amount,
                'sub_total' => $item->sub_total,
                'invoice_id' => $purchaseInvoice->id,
                'currency' => $item->currency
            ]);

        }

        $this->productRepo->updateManyQuantity($purchaseInvoice->items, $request->warehouse_id, true);
        // $this->stockRepo->addProduct($);
        return redirect()->route('invoice.purchase.index')->with('success', 'Added Invoice');
    }

    public function salesInvoiceStore(Request $request)
    {
        $total  = 0;
        $vat_amount = 0;

        $this->validate($request, [
            'customer_id' => 'required',
            'customer_account' => 'required',
            // 'invoice_num' => 'required',
            'invoice_date' => 'sometimes|date',
            'truck_num' => 'required',
            'warehouse_id' => 'required',
            // 'vat_num' => 'required',
            // 'items' => 'required'
        ]);
        //validate the request
        $request->request->set('customer_account', explode(' - ', $request->customer_account)[1]);

        $amt = json_decode($request->items);
        $val = array_reduce($amt, function ($item, $a) {
            return $a->amount + $item;
        }, 0);
        $request->request->set('sub_total', $val);


        
        $request->request->set('items', json_decode($request->items));
        foreach ($request->items as $item) {
            $item->sub_total = $item->amount;
            
            if($item->product_name == "Unleaded 95"){
                $item_vat = $item->amount * 0.11;
                $vat_amount += $item_vat;
                $total+= ($item->amount + $item_vat );
                $item->amount = ($item->sub_total + $item_vat );
            }
        }
        
        if($total == 0) $total = $val;
        $request->request->set('total',$total);
        $request->request->set('vat_amount', $vat_amount);
        
        $salesInvoice =  $this->invoiceRepo->addSalesInvoice($request->except('items'));
        foreach ($request->items as $item) {
            # code...
            // $salesItem = new SalesItem($item);
            $sale_item = SalesItem::create([
                'product_name' => $item->product_name,
                'compartment' => $item->compartment,
                'quantity_observed' => $item->quantity_observed,
                'coefficient' => $item->coefficient,
                'price_vat' => $item->price_vat ?$item->price_vat: 0,
                'quantity_15deg' => $item->quantity_15deg,
                'invoice_date' => $item->invoice_date,
                'price' => $item->price,
                'amount' => $item->amount,
                'sub_total' => $item->sub_total,
                'invoice_id' => $salesInvoice->id,
                'currency' => $item->currency
            ]);
        }
        
        // $salesInvoice->items()->save($request->items);
        $this->productRepo->updateManyQuantity($salesInvoice->items, $request->warehouse_id, false);

        return redirect()->route('invoice.sales.index')->with('success','Invoice Added Successfully');
    }

    // public function actions(Request $request)
    // {
    //     if ($request->has('print')) {
    //         return redirect()->route('print-sales-invoice', ['request' => $request]);
    //     } else {
    //         return redirect()->action('PaymentController@makeSales', ['request' => $request]);
    //     }

    //     // print -sales -
    // }

    public function tester(Request $request)
    {
        dd('In Here');
    }

    public function fetchInvoiceDetails(Request $request)
    {
        $invoice_id = $request->invoice_id;

        $invoice_data = $this->invoiceRepo->findSalesInvoiceByID($invoice_id);
        if ($invoice_data) {
            return ['status' => 'success', 'data' => $invoice_data];
        } else {
            return ['status' => 'error', 'data' => null];
        }
    }

    public function fetchReceiptDetails(Request $request)
    {
        $invoice_id = $request->invoice_id;


        $invoice_data = $this->invoiceRepo->findSalesReceiptByID($invoice_id);
        if ($invoice_data) {
            return ['status' => 'success', 'data' => $invoice_data];
        } else {
            return ['status' => 'error', 'data' => null];
        }
    }

    public function fetchSalesInvoice(Request $request)
    {
        $invoice_id = $request->invoice_id;

        $invoice_data = $this->invoiceRepo->findSalesInvoiceByID($invoice_id);
        if ($invoice_data) {
            return ['status' => 'success', 'data' => $invoice_data];
        } else {
            return ['status' => 'error', 'data' => null];
        }
    }

    public function fetchPurchaseInvoice(Request $request)
    {
        $invoice_id = $request->invoice_id;

        $invoice_data = $this->invoiceRepo->findPurchaseInvoiceByID($invoice_id);
        if ($invoice_data) {
            return ['status' => 'success', 'data' => $invoice_data];
        } else {
            return ['status' => 'error', 'data' => null];
        }
    }

    public function deleteInvoice(Request $request)
    {
        $invoice = $this->invoiceRepo->findSalesInvoiceByID($request->invoice_id);

        if (!$invoice) {
            return back()->with('error', 'Error Deleting Invoice, Check Invoice and Try Again!');
        } else {
            if ($request->has('mark_unpaid')) {
                $this->invoiceRepo->markInvoiceAsUnpaid($invoice->invoice_id);
                return back()->with('success', "Invoice marked as unpaid");
            } else {
                $this->invoiceRepo->deleteInvoice($invoice->invoice_id);
                return back()->with('success', 'Deleted Invoice Successfully');
            }



            // $this->invoiceRepo->deleteInvoice($invoice->id);
        }
    }

    public function invoiceActions(Request $request)
    {
        if ($request->has('delete')) {
            $deleted = $this->invoiceRepo->deleteInvoice($request->invoice_id);
            if ($deleted) return back()->with('success', 'Deleted Invoice Successfully');
        } else if ($request->has('edit')) {
            return redirect()->route('edit-invoice', ['invoice_id' => $request->invoice_id]);
        } else {
            return back()->with('info', 'Click one of the buttons to proceed');
        }
    }

    public function invoiceActionsPurchase(Request $request)
    {
        if ($request->has('delete')) {
            $deleted = $this->invoiceRepo->deleteInvoice($request->invoice_id, 'purchase');
            if ($deleted) return back()->with('success', 'Deleted Invoice Successfully');
        } else if ($request->has('edit')) {
            return redirect()->route('edit-invoice-purchase', ['invoice_id' => $request->invoice_id]);
        } else {
            return back()->with('info', 'Click one of the buttons to proceed');
        }
    }

    public function editForm(Request $request, $invoice)
    {
        $invoice = $this->invoiceRepo->findSalesInvoiceByID($invoice);
        $customers = $this->customerRepo->allCustomers();
        $stocks = $this->stockRepo->allStocks();
        // $products = $this->productRepo->listProducts();
        $products = Product::all();
        return view('invoices.sales.edit', compact('invoice', 'customers', 'stocks', 'products'));
    }

    public function editFormPurchase(Request $request, $invoice)
    {
        $invoice = $this->invoiceRepo->findPurchaseInvoiceByID($invoice);
        $suppliers = $this->customerRepo->allSuppliers();
        $stocks = $this->stockRepo->allStocks();
        // $products = $this->productRepo->listProducts();
        $products = Product::all();
        // $products = collect($products);
        return view('invoices.purchase.edit', compact('invoice', 'suppliers', 'stocks', 'products'));
    }

    public function edit(Request $request, $invoice)
    {
        $total = 0;

        $invoice = $this->invoiceRepo->findSalesInvoiceByID($invoice);
        // check the formula to compute the new amount

        // $invoice->map(function($data){
        // dd($invoice);
        // });
        $items = $invoice->items;
        foreach ($items as $key => $value) {
            // $price = 'price-' . $key;
            $price_per_tin = $request['price'][$key];
            $amount = ($value['quantity_15deg'] / 20) * $price_per_tin;
            $items[$key]['amount'] = $amount;
            $items[$key]['price'] = $price_per_tin;
            $items[$key]['product_name'] = $request['product_name'][$key];
            $items[$key]['compartment'] = $request['compartment'][$key];
            $items[$key]['quantity_observed'] = $request['quantity_observed'][$key];
            $items[$key]['coefficient'] = $request['coefficient'][$key];
            $items[$key]['quantity_15deg'] = $request['quantity_15deg'][$key];
            $items[$key]['currency'] = $request['currency'][$key];
            $items[$key]['compartment'] = $request['compartment'][$key];
            $total += $amount;
        }

        $request->request->set('items', $items);
        $request->request->set('total', $total);

        $invoice->items = $items;
        $invoice->total = $total;
        $invoice->update($request->except(['invoice_date', 'price']));
        if ($invoice->save()) {
            return redirect()->route('invoice.sales.index')->with('success', 'Updated Invoice Successfully');
        }







        // (quanty_observed * co-efficent) / 20 * price per tin;
        // check the new price per tin,
        // compute the new amount for each
        // update the amount in the corresponding items array with the new prices
        // Update the items array of the invoice and save;
        // $invoice->update($request->all());
    }

    public function editPurchase(Request $request, $invoice)
    {
        // dd($request);
        $total = 0;

        $invoice = $this->invoiceRepo->findPurchaseInvoiceByID($invoice);
        // check the formula to compute the new amount

        // $invoice->map(function($data){
        // dd($invoice);
        // });
        $items = $invoice->items;
        // dd($items);
        foreach ($items as $key => $value) {
            // $price = 'price-' . $key;
            $price_per_tin = $request['price'][$key];
            $amount = ($value['quantity_15deg'] / 20) * $price_per_tin;
            $items[$key]['amount'] = $amount;
            $items[$key]['price'] = $price_per_tin;
            $items[$key]['product_name'] = $request['product_name'][$key];
            $items[$key]['compartment'] = $request['compartment'][$key];
            $items[$key]['quantity_observed'] = $request['quantity_observed'][$key];
            $items[$key]['coefficient'] = $request['coefficient'][$key];
            $items[$key]['quantity_15deg'] = $request['quantity_15deg'][$key];
            $items[$key]['currency'] = $request['currency'][$key];
            $items[$key]['compartment'] = $request['compartment'][$key];
            $total += $amount;
        }

        $request->request->set('items', $items);
        $request->request->set('total', $total);
        // dd($request);
        // $invoice->items = $items;
        // $invoice->total = $total;
        $invoice->update($request->except(['invoice_date', 'price']));
        if ($invoice->save()) {
            return redirect()->route('invoice.purchase.index')->with('success', 'Updated Invoice Successfully');
        }







        // (quanty_observed * co-efficent) / 20 * price per tin;
        // check the new price per tin,
        // compute the new amount for each
        // update the amount in the corresponding items array with the new prices
        // Update the items array of the invoice and save;
        // $invoice->update($request->all());
    }
}
