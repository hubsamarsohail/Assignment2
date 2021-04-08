<?php

namespace App\Http\Controllers;

use App\Interfaces\CustomerRepositoryInterface;
use App\Interfaces\InvoiceRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\StockRepositoryInterface;
use App\Models\PurchaseDeliveryNotice;
use App\Models\PurchaseInvoice;
use App\Models\SalesDeliveryNotice;
use App\Models\SalesInvoice;
use Illuminate\Http\Request;

class DeliveryNoticeController extends Controller
{
    //
    public $customerRepo;
    public $invoiceRepo;
    public $productRepo;
    public $stockRepo;
    public function __construct(
        CustomerRepositoryInterface $customerRepo,
        InvoiceRepositoryInterface $invoiceRepo,
        StockRepositoryInterface $stockRepo,
        ProductRepositoryInterface $productRepo
    ) {

        $this->customerRepo = $customerRepo;
        $this->invoiceRepo = $invoiceRepo;
        $this->stockRepo = $stockRepo;
        $this->productRepo = $productRepo;
    }

    public function storePurchaseNotice(Request $request)
    {
        $request->request->set('supplier_account', explode(' - ', $request->supplier_account)[1]);

        $request->request->set('items', json_decode($request->items));
        $this->invoiceRepo->addPurchaseDeliveryNotice($request->all());
        // $this->productRepo->updateManyQuantity($purchaseInvoice->items, $request->warehouse_id, true);
        // $this->stockRepo->addProduct($);
        return redirect()->action('DeliveryNoticeController@showPurchaseForm');
        // return redirect()->route('invoice.purchase.index')->with('success', 'Added Invoice');
    }

    public function storeSalesNotice(Request $request)
    {
        $request->request->set('customer_account', explode(' - ', $request->customer_account)[1]);

        $request->request->set('items', json_decode($request->items));
        // dd($request);
        $this->invoiceRepo->addSalesDeliveryNotice($request->all());
        // $this->productRepo->updateManyQuantity($salesInvoice->items, $request->warehouse_id, false);
        return redirect()->action('DeliveryNoticeController@showSalesForm');
    }

    public function showPurchaseForm(Request $request, $supplier = '', $invoiceDate = '')
    {

        $suppliers = $this->customerRepo->allSuppliers();
        $purchase_delivery_notice = $this->invoiceRepo->purchaseDeliveryNotice();
        $stocks = $this->stockRepo->allStocks();
        $products = $this->productRepo->listProducts();
        return view('notice.purchase.index', compact(['suppliers', 'stocks', 'purchase_delivery_notice', 'products']));


        // $purchase_report = [];
        // $supplier = $supplier == '' ? null : $supplier;
        // $invoiceDate = $invoiceDate = '' ? null : $invoiceDate;
        // $suppliers = $this->customerRepo->allSuppliers();
        // if ($request->has('supplier_id') && $request->supplier_id != null) {
        //     $purchase_report = $this->invoiceRepo->purchaseReport($supplier, $invoiceDate);
        // }

        // return view('reports.purchase.report', compact('suppliers', 'purchase_report'));
    }


    public function showSalesForm(Request $request, $customer = '', $invoiceDate = '')
    {
        $customers = $this->customerRepo->allCustomers();
        $sales_delivery_notice = $this->invoiceRepo->salesDeliveryNotice();
        $stocks = $this->stockRepo->allStocks();
        $products = $this->productRepo->listProducts();
        return view('notice.sales.index', compact(['customers', 'stocks', 'sales_delivery_notice', 'products']));
    }

    public function fetchSalesDetails(Request $request)
    {
        $invoice_id = $request->invoice_id;
        return SalesDeliveryNotice::where('invoice_id', $invoice_id)->first();
    }

    public function fetchPurchaseDetails(Request $request)
    {
        $invoice_id = $request->invoice_id;
        return PurchaseDeliveryNotice::where('invoice_id', $invoice_id)->first();
    }


    public function generatePurchaseInvoice(Request $request)
    {
        $total = 0;
        // dd($request);
        $invoice = $this->invoiceRepo->findPurchaseNoticeByID($request->invoice_id);
        // $invoice->map(function($data){

        // });
        $items = $invoice->items;
        foreach ($items as $key => $value) {
            $price = 'price-' . $key;
            $price_per_tin = $request[$price];
            $amount = ($value['quantity_15deg'] / 20) * $price_per_tin;
            $items[$key]['amount'] = $amount;
            $items[$key]['price'] = $price_per_tin;
            $total += $amount;
            // "product_name" => "First Line"
            // "compartment" => "1,5,2"
            // "quantity_observed" => "123"
            // "coefficient" => "32"
            // "quantity_15deg" => "3936"
            // "currency" => "USD"
            // "invoice_date" => "Tue Jul 14 2020"
            // $(`#amount-${index}`).val(((parseFloat(evt.target.value) / 20) * parseFloat(price_p)).toFixed(2));
            // dd($value);
            // take the key which is zero based integer;
            // then take the price attached to the index;
            // and calculate the invoice amount from the value of the invoice notice;
            // then dublicate the invoice-notice and add it as an actual invoice
            // echo ($key);
        }

        $invoice->items = $items;
        $purchaseInvoice = PurchaseInvoice::make($invoice->toArray());
        $purchaseInvoice->total = $total;
        if ($purchaseInvoice->save()) {
            $invoice->delete();
        }
        return redirect()->route('purchase-notice')->with('success', 'Generated Invoice Successfully');
        // $invoice->total = $amount;
        // dd($invoice->items);
    }

    public function generateSalesInvoice(Request $request)
    {
        $total = 0;
        // dd($request);
        $invoice = $this->invoiceRepo->findSalesNoticeByID($request->invoice_id);
        // $invoice->map(function($data){
        // dd($invoice);
        // });
        $items = $invoice->items;
        foreach ($items as $key => $value) {
            $price = 'price-' . $key;
            $price_per_tin = $request[$price];
            $amount = ($value['quantity_15deg'] / 20) * $price_per_tin;
            $items[$key]['amount'] = $amount;
            $items[$key]['price'] = $price_per_tin;
            $total += $amount;
        }

        $invoice->items = $items;
        $salesInvoice = SalesInvoice::make($invoice->toArray());
        $salesInvoice->total = $total;
        if ($salesInvoice->save()) {
            $invoice->delete();
        }
        return redirect()->route('sales-notice')->with('success', 'Generated Invoice Successfully');
        // $invoice->total = $amount;
        // dd($invoice->items);
    }

    public function salesActions(Request $request)
    {
        $notice = SalesDeliveryNotice::where('invoice_id', $request->invoice_id)->first();
        if (!$notice) {
            return back()->with('error', 'Error Processing Your Request! Check the form and fill accordingly');
        }

        if ($request->has('edit')) {
            return redirect()->route('sales-notice-edit-form', ['notice_id' => $notice->invoice_id]);
        } else if ($request->has('delete')) {
            $notice->delete();
            return back()->with('success', 'Successfully Deleted Sales Delivery Notice');
        } else {
            return back()->with('error', 'Error Processing Your Request! Try Again Later');
        }
    }

    public function purchaseActions(Request $request)
    {

        $notice = PurchaseDeliveryNotice::where('invoice_id', $request->invoice_id)->first();
        if (!$notice) {
            return back()->with('error', 'Error Processing Your Request! Check the form and fill accordingly');
        }

        if ($request->has('edit')) {
            return redirect()->route('purchase-notice-edit-form', ['notice_id' => $notice->invoice_id]);
        } else if ($request->has('delete')) {
            $notice->delete();
            return back()->with('success', 'Successfully Deleted Sales Delivery Notice');
        } else {
            return back()->with('error', 'Error Processing Your Request! Try Again Later');
        }
    }

    public function showSalesEditForm(Request $request, $notice_id)
    {
        $customers = $this->customerRepo->allCustomers();
        $stocks = $this->stockRepo->allStocks();
        $products = $this->productRepo->listProducts();
        $products = json_decode($products);
        $notice = SalesDeliveryNotice::where('invoice_id', $notice_id)->first();
        return view('notice.sales.edit', compact('notice', 'products', 'stocks', 'customers'));
    }


    public function showPurchaseEditForm(Request $request, $notice_id)
    {
        $customers = $this->customerRepo->allCustomers();
        $stocks = $this->stockRepo->allStocks();
        $products = $this->productRepo->listProducts();
        $products = json_decode($products);
        $notice = PurchaseDeliveryNotice::where('invoice_id', $notice_id)->first();
        return view('notice.purchase.edit', compact('notice', 'products', 'stocks', 'customers'));
    }


    public function salesEdit(Request $request, $notice_id)
    {
        // dd($request);
        // dd($request['product_name'][1]);
        $notice = SalesDeliveryNotice::where('invoice_id', $notice_id)->first();

        // dd($items[0]);

        $items = $notice->items;
        $finalItem = [];




        foreach ($items as $key => $item) {
            // // echo $loop->iteration;
            // foreach ($value as $key1 => $itsValue) {
            //     $items[$key][$key1] = $request[$key1][$key];
            // }
            $finalItem[$key] = [];
            $keys = array_keys($item);
            // dd($keys);
            foreach ($keys as $itemKey) {
                if ($itemKey == 'invoice_date' || $itemKey == 'currency' || $itemKey == 'quantity_15deg') continue;
                $finalItem[$key][$itemKey] = $request[$itemKey][$key];
                $finalItem[$key]['quantity_15deg'] = (float)($request['quantity_observed'][$key]) * (float)($request['coefficient'][$key]);
                $finalItem[$key]['currency'] = $item['currency'];
                $finalItem[$key]['invoice_date'] = $request->has('invoice_date') ? $request['invoice_date'] : $item['invoice_date'];
                // dd($singleItem);
                // dd($finalItem[$key][$itemKey]);
                // $finalItem[$key][$itemKey] = $request[$itemKey][$key];
            }
            // $price = 'price-' . $key;
            // $price_per_tin = $request['price'][$key];
            // $amount = ($value['quantity_15deg'] / 20) * $price_per_tin;
            // $items[$key]['amount'] = $amount;
            // $items[$key]['price'] = $price_per_tin;
            // $total += $amount;
        }
        // dd($finalItem);
        // dd('done');

        $notice->update($request->all());
        $notice->items = $finalItem;
        // $notice->total = $total;
        $notice->save();
        return back()->with('success', 'Updated Delivery Notice');
    }


    public function purchaseEdit(Request $request, $notice_id)
    {
        // dd($request);
        // dd($request['product_name'][1]);
        $notice = PurchaseDeliveryNotice::where('invoice_id', $notice_id)->first();

        // dd($items[0]);

        $items = $notice->items;
        $finalItem = [];




        foreach ($items as $key => $item) {
            // // echo $loop->iteration;
            // foreach ($value as $key1 => $itsValue) {
            //     $items[$key][$key1] = $request[$key1][$key];
            // }
            $finalItem[$key] = [];
            $keys = array_keys($item);
            // dd($keys);
            foreach ($keys as $itemKey) {
                if ($itemKey == 'invoice_date' || $itemKey == 'currency' || $itemKey == 'quantity_15deg') continue;
                $finalItem[$key][$itemKey] = $request[$itemKey][$key];
                $finalItem[$key]['quantity_15deg'] = (float)($request['quantity_observed'][$key]) * (float)($request['coefficient'][$key]);
                $finalItem[$key]['currency'] = $item['currency'];
                $finalItem[$key]['invoice_date'] = $request->has('invoice_date') ? $request['invoice_date'] : $item['invoice_date'];
                // dd($singleItem);
                // dd($finalItem[$key][$itemKey]);
                // $finalItem[$key][$itemKey] = $request[$itemKey][$key];
            }
            // $price = 'price-' . $key;
            // $price_per_tin = $request['price'][$key];
            // $amount = ($value['quantity_15deg'] / 20) * $price_per_tin;
            // $items[$key]['amount'] = $amount;
            // $items[$key]['price'] = $price_per_tin;
            // $total += $amount;
        }
        // dd($finalItem);
        // dd('done');

        $notice->update($request->all());
        $notice->items = $finalItem;
        // $notice->total = $total;
        $notice->save();
        return back()->with('success', 'Updated Delivery Notice');
    }
}
