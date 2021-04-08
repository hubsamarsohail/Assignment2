<?php

namespace App\Interfaces;

interface InvoiceRepositoryInterface
{
    public function addSalesInvoice($data);

    public function addPurchaseInvoice($data);

    public function deleteSalesInvoice($invoice_id);

    public function deletePurchaseInvoice($invoice_id);

    public function findSalesInvoiceByID($invoice_id);

    public function findPurchaseInvoiceByID($invoice_id);

    public function restoreInvoice($invoice_id);

    public function updateInvoice($invoice_id, $data);

    public function allPurchaseInvoices($limit = 10);
    public function findSalesReceiptByID($invoice_id);
    public function allSalesInvoices();
    public function allUnpaidSalesInvoices();
    public function allPaidSalesInvoices();

    public function allUnpaidPurchaseInvoices();
    public function allPaidPurchaseInvoices();

    public function allPaymentReceipt();

    public function salesReport($supplier, $invoiceDate , $invoiceDate2 );

    public function purchaseReport($customer, $invoiceDate);

    public function salesDeliveryNotice();
    public function purchaseDeliveryNotice();

    public function addSalesDeliveryNotice($data);
    public function addPurchaseDeliveryNotice($data);

    public function findPurchaseNoticeByID($invoice_id);
    public function findSalesNoticeByID($invoice_id);


    public function computeVat($items);
    public function markInvoiceAsUnpaid($invoice_id);
    public function deleteInvoice($invoice_id, $type = "");
}
