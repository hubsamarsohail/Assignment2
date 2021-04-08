<?php

namespace App\Interfaces;

interface CustomerRepositoryInterface
{
    public function addCustomer($data);
    public function deleteCustomer($customer_id);
    public function findByID($customer_id);
    public function restoreCustomer($customer_id);
    public function updateCustomer($customer_id, $data);
    public function allSuppliers();
    public function fetchVendorAccount($id);
    public function fetchCustomerAccount($id);
    public function allCustomers();
}
