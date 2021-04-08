<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('fetchVendorAccount', 'CustomerController@fetchVendorAccount');
Route::post('fetchCustomerAccount', 'CustomerController@fetchCustomerAccount');
Route::post('get-invoice-details', 'InvoiceController@fetchInvoiceDetails');
Route::post('get-receipt-details', 'InvoiceController@fetchReceiptDetails');
Route::post('get-invoice-details-purchase', 'InvoiceController@fetchPurchaseInvoice');
Route::post('/get-purchase-notice-details', 'DeliveryNoticeController@fetchPurchaseDetails');
Route::post('/get-sales-notice-details', 'DeliveryNoticeController@fetchSalesDetails');
Route::get('fetch-products', 'ProductController@productList');
