<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);
Route::get('/', function () {
    return view('welcome');
});

// Route::group(['middleware' => 'auth'], function () {

    Route::resource('customers', 'CustomerController');
    Route::resource('product', 'ProductController');
    Route::resource('stock', 'StockController');
    Route::resource('vechile', 'VechileController');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/invoices/purchases', 'InvoiceController@purchaseInvoiceCreateForm')->name('invoice.purchase.index');
    Route::get('/invoices/sales', 'InvoiceController@salesInvoiceCreateForm')->name('invoice.sales.index');
    Route::post('/invoices/purchases', 'InvoiceController@purchaseInvoiceStore')->name('invoice.purchase.store');
    Route::delete('invoices/sales', 'InvoiceController@deleteInvoice')->name('delete-invoice');
    Route::post('/invoices/sales', 'InvoiceController@salesInvoiceStore')->name('invoice.sales.store');
    Route::get('invoices/sales/payment', 'PaymentController@sales')->name('invoice.sales.payment');
    Route::post('invoices/sales/payment', 'PaymentController@makeSalesPayment')->name('invoice.sales.payment');
    Route::post('invoice/sales/actions', 'InvoiceController@invoiceActions')->name('invoice-actions');
    Route::post('invoice/purchase/actions', 'InvoiceController@invoiceActionsPurchase')->name('purchase-invoice-actions');
    Route::get('sales-invoice/{invoice_id}/edit', 'InvoiceController@editForm')->name('edit-invoice');
    Route::get('purchase-invoice/{invoice_id}/edit', 'InvoiceController@editFormPurchase')->name('edit-invoice-purchase');
    Route::post('sales-invoice/{invoice_id}/edit', 'InvoiceController@edit')->name('edit-invoice');
    Route::post('purchase-invoice/{invoice_id}/edit', 'InvoiceController@editPurchase')->name('edit-invoice-purchase');

    // Route::get('invoices/purchase/payment', 'PaymentController@purchase')->name('invoice.purchase.payment');
    // Route::post('invoices/purchase/payment', 'PaymentController@makepurchasePayment')->name('invoice.purchase.payment');

    Route::get('/report/sales', 'ReportController@sales_report')->name('sales-report');
    // Route::post('/report/sales', 'ReportController@salesReport')->name('sales-report');
    Route::get('/report/purchase', 'ReportController@purchase_report')->name('purchase-report');

    Route::get('/statement-account', 'ReportController@statement_index');

    Route::any('/statement-account/report', 'ReportController@statement_index')->name('statement-account/report');

    

    Route::get('/notice/purchase-delivery', 'DeliveryNoticeController@showPurchaseForm')->name('purchase-notice');
    Route::get('/notice/sales-delivery', 'DeliveryNoticeController@showSalesForm')->name('sales-notice');
    Route::post('notice/purchase-delivery', 'DeliveryNoticeController@storePurchaseNotice')->name('store-purchase-notice');
    Route::post('notice/sales-delivery', 'DeliveryNoticeController@storeSalesNotice')->name('store-sales-notice');
    Route::post('notice/purchase/generate-invoice', 'DeliveryNoticeController@generatePurchaseInvoice')->name('generate-purchase-invoice');
    Route::post('notice/sales/generate-invoice', 'DeliveryNoticeController@generateSalesInvoice')->name('generate-sales-invoice');
    Route::post('/notice/sales/actions', 'DeliveryNoticeController@salesActions')->name('sales-notice-action');
    Route::post('/notice/sales/actions', 'DeliveryNoticeController@purchaseActions')->name('purchase-notice-action');
    Route::get('sales-notice/{notice_id}/edit', 'DeliveryNoticeController@showSalesEditForm')->name('sales-notice-edit-form');
    Route::post('sales-notice/{notice_id}/edit', 'DeliveryNoticeController@salesEdit')->name('sales-notice-edit');

    Route::get('purchase-notice/{notice_id}/edit', 'DeliveryNoticeController@showPurchaseEditForm')->name('purchase-notice-edit-form');
    Route::post('purchase-notice/{notice_id}/edit', 'DeliveryNoticeController@purchaseEdit')->name('purchase-notice-edit');


    Route::get('currencies', 'CurrencyController@index');

    Route::post('currencies.store', 'CurrencyController@store')->name('currencies.store');

    
    


    // Route::get('/report/purchase', 'ReportController@purchaseReport')->name('purchase-report-');
    // Route::get('/report/{customer}/purchase', 'ReportController@purchaseReport')->name('purchase-report-customer');
// });

Route::group(['prefix' => 'print'], function () {
    Route::post('invoice/purchase', 'PrintController@purchaseInvoice')->name('print-purchase-invoice');
    Route::post('invoice/sales', 'PrintController@salesInvoice')->name('print-sales-invoice');
    Route::post('invoice/receipt', 'PrintController@printReceipt')->name('print-receipt');
});










// Route::get('/customers', 'CustomerController@index')->name('customers');
// Route::post('/customers', 'CustomerController@store')->name('customers');


Route::any('{all}', function ($all) {
    return view('error', compact('all'));
})->where('all', '.*');
