<?php

namespace App\Http\Controllers;

use App\Interfaces\CustomerRepositoryInterface;
use App\Interfaces\InvoiceRepositoryInterface;
use App\Models\SalesInvoice;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\SalesReceipt;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public $customerRepo;
    public $invoiceRepo;

    public function __construct(CustomerRepositoryInterface $customerRepo, InvoiceRepositoryInterface $invoiceRepo)
    {
        $this->customerRepo = $customerRepo;
        $this->invoiceRepo = $invoiceRepo;
    }

    //
    public function sales_report(Request $request, $customer = '', $invoiceDate = '', $invoiceDate2 = '')
    {
        $sales_report = [];
        $customer = $customer == '' ? null : $customer;
        $invoiceDate = $invoiceDate = '' ? null : $invoiceDate;
        $invoiceDate2 = $invoiceDate2 = '' ? null : $invoiceDate2;

        if ($request->has('customer_id') && $request->customer_id != null) {
            $sales_report = $this->invoiceRepo->salesReport($request->get('customer_id'),  $request->from_date, $request->end_date);
        } else {

            $sales_report = $this->invoiceRepo->salesReport($customer, $invoiceDate, $invoiceDate2);
        }

        $customers = $this->customerRepo->allCustomers();
        $customer_id =   $request->customer_id;
        $from_date =    $request->from_date;
        $end_date =  $request->end_date;

        return view('reports.sales.report', compact('customers', 'customer_id', 'from_date', 'end_date', 'sales_report'));
    }

    public function purchaseReport(Request $request)
    {
        // $purchase_report = $this->invoiceRepo->purchaseReport($request);
        // $suppliers = $this->customerRepo->allSuppliers();
        return view('reports.purchase.report');
    }

    public function purchase_report(Request $request, $supplier = '', $invoiceDate = '')
    {

        $purchase_report = [];
        $supplier = $supplier == '' ? null : $supplier;
        $invoiceDate = $invoiceDate = '' ? null : $invoiceDate;
        $suppliers = $this->customerRepo->allSuppliers();
        if ($request->has('supplier_id') && $request->supplier_id != null) {
            $purchase_report = $this->invoiceRepo->purchaseReport($supplier, $invoiceDate);
        }

        return view('reports.purchase.report', compact('suppliers', 'purchase_report'));
    }


    public function statement_index(Request $request){
      
        // $this->validate($request, [
        //     'customer_id' => 'required',
         
        // ]);
        $customers =      Customer::get();
        $currencies  =     Currency::get();

        $from_date =     $request->from_date ?? '';
        $to_date =  $request->to_date ?? '' ;
        $customer_id = $request->customer_id ?? '';
        $currency_id  = $request->currency_id ?? '';

        
  

        // $sale_receipts =   SalesReceipt::select(DB::raw('amount as debit, 0.00 as credit '))->get();


        // $saleinvoice =   SalesInvoice::select(DB::raw('0.00 as debit, total as credit '))->union($sale_receipts)->get();
        // dd($saleinvoice[0]);

        //$results = DB::select('SELECT 0.00 as debit, total as credit, created_at as date FROM `sales_invoices` WHERE customer_id = 2')  );
       
       
       
        //$sql1 =  DB::raw('SELECT 0.00 as debit, total as credit, created_at as date FROM `sales_invoices` WHERE customer_id = 2'); 
        //$sql2 =  DB::raw('SELECT amount as debit, 0.00 as credit, created_at as date FROM `sales_receipts` WHERE customer_id = 2');
        

       //$results = $sql1->union($sql2)->orderBy('date');
       
     
        //$results->unionAll($results_receipt);

      // dd($results);

        //$saleinvoices =   DB::table('sales_invoices')->selectRaw("00 as debit ,  total as credit , created_at as date")->get();

        
        

         $saleinvoices =     DB::table('sales_invoices')->where('customer_id',2)->select('id', 'total as debt', DB::raw('0 as credit'), 'created_at', DB::raw('select currency from sales_items where '));
        
         $results =     DB::table('sales_receipts')->where('customer_id',2)->select('id' , DB::raw('0 as debt'), 'amount as credit', 'created_at');
         
         $results2 = $results->union($saleinvoices)->orderby('created_at')->get();
       
        
        // $saleinvoices =  DB::table('sales_invoices')->where('customer_id', $customer_id )->select(DB::raw('0.00 as debit, total as credit  , created_at as date  '))->get();
       
        //$sale_receipt =  DB::table('sales_receipts')->selectRaw("amount as debit ,  0 as credit , created_at as date ")->get();
      
        //$sale_receipt->union($saleinvoices);

       

        return view('reports.statement-account.index' , compact('currencies', 'customers' ));
    }
    
}
