@extends('layouts.app')

@section('content')
{{-- {{dd($purchase_report)}} --}}
    <section class="content-header">
        <h1>
            Purchase Reports
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
         <section class="content">

            <div class="row">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Reports</h3>
                    </div>
                    <div class="box-body">
                        <form class="form-horizontal" method="POST" action="{{route('purchase-report')}}" id="invoice-form" >
                            @method('GET')
                @csrf
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="supplier_id" class="col-sm-3 control-label">Supplier *</label>
                      <div class="col-sm-9">
                          <select class="form-control" name="supplier_id" id="supplier_id">
                            <option value="">Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                            <option value="{{$supplier->id}}" >{{$supplier->customer_name_english}}</option>
                            @endforeach
                          </select>
                        {{-- <input type="text" name="supplier_id" class="form-control" id="supplier_id" placeholder="Supplier Name English" value="{{old('supplier_id') ? old('supplier_id') : ''}}"> --}}
                        @error('supplier_id')
                          <div class="text-danger">
                            Select Supplier
                          </div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                            <label for="invoice_date" class="col-sm-3 control-label">Invoice Date</label>
                            <div class="col-sm-9">
                              <input type="date" name="invoice_date" class="form-control" id="invoice_date" placeholder="dd/mm/yyyy" value="{{old('invoice_date') ? old('invoice_date') : ''}}">
                              @error('invoice_date')
                                <div class="text-danger">
                                  {{$message}}
                                </div>
                              @enderror
                            </div>
                          </div>
                  </div>
                </div>

                    </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right" id="save-invoice-btn">View Report</button>
              </div>
            </form>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="box">
                    <div class="box-header">
                     <h3 class="box-title">Purchase Report</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    {{-- <th>ID</th>
                                    <th>Supplier Name</th>
                                    <th>Invoice No</th>
                                    <th>Truck No</th>
                                    <th>Warehouse</th>
                                    <th>Total</th>
                                    <th>Note</th>
                                    <th>Invoice Date</th> --}}
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Quantity Observed</th>
                                    <th>Co-efficient</th>
                                    <th>Quantity at 15deg</th>
                                    <th>Price Per Tin</th>
                                    <th>Currency</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    {{-- <th>Supplier Name</th>
                                    <th>Invoice No</th>
                                    <th>Truck No</th>
                                    <th>Warehouse</th>
                                    <th>Note</th>
                                    <th>Invoice Date</th> --}}




                                    {{-- <th>View Items</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchase_report as $invoice)
                                <tr class="single-row">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$invoice['product_name']}}</td>
                                    <td>{{$invoice['quantity_observed']}}</td>
                                    <td>{{$invoice['coefficient']}}</td>
                                    <td>{{$invoice['quantity_15deg']}}</td>
                                    <td>{{$invoice['price']}}</td>
                                    <td>{{$invoice['currency']}}</td>
                                    <td>{{$invoice['amount']}}</td>
                                    <td>{{$invoice['invoice_date']}}</td>
                                    {{-- <td data-target="{{$invoice->id}}"><button data-target="{{$invoice->invoice_id}}" class=" view_invoice btn btn-primary" >View Purchase Invoice</button></td> --}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <tfoot>
                            <div style="margin-top:20px">
                                <div class="pull-right">
                                    {{-- @if(count($purchase_report))
                                    {{$purchase_report->appends(request()->except('page'))->links()}}
                                    @endif --}}
                                </div>
                            </div>
                        </tfoot>
                    </div>
                </div>
            </div>
         </section>
    </section>

@endsection
