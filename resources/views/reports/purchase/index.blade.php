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
        Purchase Reports
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
         </section>

    </section>

@endsection
