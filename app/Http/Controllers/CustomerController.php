<?php

namespace App\Http\Controllers;

use App\Helpers\FileUploader;
use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public $customerRepo;

    public function __construct(CustomerRepositoryInterface $customerRepo)
    {
        $this->customerRepo = $customerRepo;
        $this->middleware('auth')->except(['fetchVendorAccount', 'fetchCustomerAccount']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers = Customer::paginate(10);

        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the request
        // $this->validate($request, [
        //     'customer_name_english' => 'required|min:6',
        //     'customer_name_arabic' => 'required|min:6',
        //     'contact_person' => 'required|min:6',
        //     'contact_number' => 'required',
        //     'email' => 'required|unique:customers',
        //     'join_date' => 'date',
        //     'address' => 'required|min:8',
        //     'detailed_address' => 'required|min:8',
        //     'account_number' => 'required|min:6',
        //     'credit_limit' => 'required',
        //     'credit_facilities' => 'required',
        //     'discount_category' => 'required',
        //     'vat_number' => 'required',
        //     'sales_man' => 'required',
        //     'profile_pics' => 'sometimes|mimes:jpeg,bmp,png|max:2048'
        // ]);

        //create the customer;
        // Come back with the uuid then use it to store the user's photo and return to update the user's photo_url
        $customer = $this->customerRepo->addCustomer($request->except(['image_url']));

        if ($request->hasFile('profile_pics')) {
            //check if the request has a file to upload if it does upload it and then pass the resource url to the image_url then upload it.
            $path = FileUploader::upload($request, ['profile_pics'], 'profile_pics', $customer->uuid);
            $this->customerRepo->updateCustomer($customer->uuid, ['image_url' => $path]);
        }
        return redirect()->route('customers.index')->with('success', 'Added Customer Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
        return view('customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
        if ($request->has('vendor')) {
            $request->request->set('vendor', $request->vendor == 'on' ? 'true' : 'false');
        } else {
            $request->request->set('vendor', 'false');
        }

        if ($request->has('blacklist')) {
            $request->request->set('blacklist', $request->blacklist == 'on' ? 'true' : 'false');
        } else {
            $request->request->set('blacklist', 'false');
        }

        $customer->update($request->except(['email', 'join_date']));

        return back()->with('success', 'Updated User\'s Account');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Customer $customer)
    {
        dd('hi');
        //
        // dd($customer);
        // $customer->delete();
        // return redirect()->route('customers');
    }

    public function fetchVendorAccount(Request $request)
    {
        // return 'hi';
        $id = $request->id ?? null;
        return $this->customerRepo->fetchVendorAccount($id);
    }

    public function fetchCustomerAccount(Request $request)
    {
        $id = $request->id ?? null;
        return $this->customerRepo->fetchCustomerAccount($id);
    }
}
