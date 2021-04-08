<?php


namespace App\Repository;

use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function addCustomer($data)
    {
        if (key_exists('blacklist', $data)) {
            $data['blacklist'] =  'true';
        }
        if (key_exists('vendor', $data)) {
            $data['vendor'] = 'true';
        }
        return Customer::create($data);
    }
    public function deleteCustomer($customer_id)
    {
    }

    public function findByID($customer_id)
    {
        return Customer::where('uuid', $customer_id)->first();
    }

    public function restoreCustomer($customer_id)
    {
    }

    public function updateCustomer($customer_id, $data)
    {
    }

    public function allSuppliers()
    {
        return Customer::where('vendor', 'true')->get();
    }

    public function allCustomers()
    {
        return Customer::where('vendor', 'false')->get();
    }

    public function fetchVendorAccount($id)
    {
        if ($id == null) return null;
        else return Customer::where('vendor', 'true')->where('id', $id)->first();
    }

    public function fetchCustomerAccount($id)
    {
        if ($id == null) return null;
        else return Customer::where('vendor', 'false')->where('id', $id)->first();
    }
}
