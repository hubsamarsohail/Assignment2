@extends('layouts.app')

@section('content')

<section class="content-header">
    <h1>
        Sales Reports
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
                    <form class="form-horizontal" method="POST" action="{{route('sales-report')}}" id="invoice-form">
                        @csrf
                        @method('GET')
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="customer_id" class="col-sm-4 control-label">Customer *</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="customer_id" id="customer_id">
                                                <option value="">Select Customer</option>
                                                @foreach ($customers as $customer)
                                                <option value="{{$customer->id}}" @php if($customer->id == $customer_id){ echo "selected : '' "; } @endphp >{{$customer->customer_name_english}}</option>
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

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="invoice_date" class="col-sm-5 control-label">Invoice From Date</label>
                                        <div class="col-sm-7">
                                            <input type="date" name="from_date" class="form-control" value={{$from_date ?? '' }} id="invoice_date" placeholder="dd/mm/yyyy" value="{{old('from_date') ? old('from_date') : ''}}">
                                            @error('invoice_date')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="invoice_date" class="col-sm-5 control-label">Invoice To Date</label>
                                        <div class="col-sm-7">
                                            <input type="date" name="end_date" class="form-control" value={{$end_date ?? '' }} id="invoice_date" placeholder="dd/mm/yyyy" value="{{old('end_date') ? old('end_date') : ''}}">
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
                    <h3 class="box-title">Sales Report</h3>
                   
                    <!-- <form class="form-horizontal" method="POST" action="{{route('sales-report')}}" id="invoice-form">
                       @csrf
                       @method('GET')
                        <input type="text" value="1" name="excel_file" hidden />
                        
                        <input type="text" value="{{$customer_id ?? ''}}" name="customer_id" hidden />
                        <input type="text" value="{{$from_date ?? ''}}" name="from_date" hidden />
                        <input type="text" value="{{$end_date ?? ''}}" name="end_date" hidden />

                        <button type="submit" class="btn btn-primary pull-rights; " style="float: right; font-size:20px"><i class="fa fa-file-excel-o"></i></i></button>
                    </form> -->

                    
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <!-- <table class="table table-bordered table-striped"> -->
                    
<table id="invoice_table" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>

                                <th>ID</th>
                                <th>Product</th>
                                <th>Quantity Observed</th>
                                <th>Co-efficient</th>
                                <th>Quantity at 15deg</th>
                                <th>Price Per Tin</th>
                                <th>Currency</th>
                                <th>Amount</th>
                                <th>Date</th>
                                {{-- <th>View Items</th> --}}

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales_report as $invoice)
                            <tr class="single-row">
                                <td>{{$loop->iteration}}</td>

                                <td>{{$invoice['product_name']}} </td>
                                <td>{{$invoice['quantity_observed']}} </td>
                                <td>{{$invoice['coefficient']}} </td>
                                <td>{{$invoice['quantity_15deg']}} </td>
                                <td>{{$invoice['price']}} </td>
                                <td>{{$invoice['currency']}} </td>
                                <td>{{$invoice['amount']}}</td>
                                <td>{{$invoice['invoice_date']}}</td>
                                {{-- <td data-target="{{$invoice->id}}"><button data-target="{{$invoice->invoice_id}}" class=" view_invoice btn btn-primary">View Purchase Invoice</button></td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <tfoot>
                        <div style="margin-top:20px">
                            <div class="pull-right">
                                {{-- @if(count($sales_report))
                                    {{$sales_report->appends(request()->except('page'))->links()}}
                                @endif --}}
                            </div>
                        </div>
                    </tfoot>
                </div>
            </div>
        </div>
    </section>
</section>




<script src="{{asset('https://code.jquery.com/jquery-3.5.1.js')}}"></script>
<script src="{{asset('https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js')}}"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js')}}"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js')}}"></script>
<script src="{{asset('https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js')}}"></script> 





<script>

$(document).ready(function($) {

  
    $('#invoice_table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel',
            {
                extend: 'pdf',
                title: 'Satement Of Account',
                messageBottom: null,
                messageTop:  null
            },
            {
                extend: 'print',
                messageBottom: null
            }
        ],
      
    } ); 
} ); 
</script>


@endsection





@section('styles')



<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js" integrity="sha256-ZsWP0vT+akWmvEMkNYgZrPHKU9Ke8nYBPC3dqONp1mY=" crossorigin="anonymous"></script>
@endsection


