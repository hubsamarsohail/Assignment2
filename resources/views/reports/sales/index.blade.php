@extends('layouts.app')

{{-- @section('styles')
<link rel="stylesheet" href="{{asset('bower_components/datatables-bs/css/datatables.bootstrap.min.css')}}">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<style>
  .single-row{
    cursor: pointer;
  }
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
  .toggle.ios .toggle-handle { border-radius: 20px; }
</style>
@endsection --}}

@section('content')

<section class="content-header">
      <h1>
        Sales Reports
        {{-- <small>Homepage of El-Hadi</small> --}}
      </h1>
      {{-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol> --}}
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
                        <form class="form-horizontal" method="POST" action="{{route('sales-report')}}" id="invoice-form" >
                    @csrf
                    @method('GET')
                    <div class="box-body">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="customer_id" class="col-sm-3 control-label">Customer *</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="customer_id" id="customer_id">
                                <option value="">Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->customer_name_english}}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" name="customer_id" class="form-control" id="customer_id" placeholder="Customer Name English" value="{{old('customer_id') ? old('customer_id') : ''}}"> --}}
                            @error('customer_id')
                            <div class="text-danger">
                                Select Customer
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
                     <h3 class="box-title">Purchase Invoices</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer Name</th>
                                    <th>Invoice No</th>
                                    <th>Invoice Date</th>
                                    <th>Truck No</th>
                                    <th>Warehouse</th>
                                    <th>Total</th>
                                    <th>Note</th>
                                    {{-- <th>View Items</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales_report as $invoice)
                                <tr class="single-row" data-target="{{$invoice->id}}">
                                    <td>{{$invoice->id}}</td>
                                    <td>{{$invoice->supplier->supplier_name_english}}</td>
                                    <td>{{$invoice->invoice_num}}</td>
                                    <td>{{$invoice->total}}</td>
                                    <td>{{$invoice->warehouse->name}}</td>
                                    <td>{{$invoice->total}}</td>
                                    <td>{{$invoice->note}}</td>
                                    <td>{{$invoice->invoice_date->format('d-m-Y')}}</td>
                                    {{-- <td data-target="{{$invoice->id}}"><button data-target="{{$invoice->invoice_id}}" class=" view_invoice btn btn-primary" >View Purchase Invoice</button></td> --}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <tfoot>
                            <div style="margin-top:20px">
                                <div class="pull-right">
                                    {{$sales_report->append($request->except('page'))->links()}}
                                </div>
                            </div>
                        </tfoot>
                    </div>
                </div>
            </div>


         </section>

    </section>

@endsection
