@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('bower_components/datatables-bs/css/datatables.bootstrap.min.css')}}">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<style>
  .single-row{
    cursor: pointer;
  }
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
  .toggle.ios .toggle-handle { border-radius: 20px; }
</style>
@endsection

@section('content')

<section class="content-header">
      <h1>
        Statement Of Account 
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
              <h3 class="box-title">Add Statement Of Account</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{route('statement-account/report')}}" onsubmit="return validateReportform()" >
                @csrf

              <div class="box-body">
              
              
             

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact_person" class="col-sm-3 control-label">From Date</label>
                            <div class="col-sm-9">
                             <input type="date" name="from_date" class="form-control" id="from_date" placeholder="" value="{{old('from_date') ? old('from_date') : ''}}">
                              @error('name')
                                <div class="text-danger">
                                  Enter Customer's Contact Person
                                </div>
                              @enderror
                            </div>
                          </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="contact_number" class="col-sm-3 control-label">To Date</label>
                            <div class="col-sm-9">
                              <input type="date" name="to_date" class="form-control" id="to_date" placeholder="Enter Rate" value="{{old('to_date') ? old('to_date') : ''}}">
                              @error('rate')
                                <div class="text-danger">
                                    Enter Rate
                                </div>
                              @enderror
                            </div>
                          </div>
                    </div>
                </div>


                
                <div class="row">

                <div class="col-md-6">
                         <div class="form-group">
                            <label for="credit_facilities" class="col-sm-3 control-label">Customer</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="customer_id" id="customer_id">
                                <option value="">Select Customer</option>
                                @foreach ($customers as $customer)
                                                <option value="{{$customer->id}}" @php if($customer->id == 'customer_id'){ echo "selected : '' "; } @endphp >{{$customer->customer_name_english}}</option>
                                                @endforeach
                              </select>
                              @error('credit_facilities')
                                <div class="text-danger">
                                  {{$message}}
                                </div>
                              @enderror
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                         <div class="form-group">
                            <label for="credit_facilities" class="col-sm-3 control-label">Currency</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="currency_id" id="currency_id">
                                <option value="">Select Currency</option>
                                @foreach ($currencies as $currency_id)
                                                <option value="{{$currency_id->id}}" @php if($currency_id->id == 'currency_id'){ echo "selected : '' "; } @endphp >{{$currency_id->name}}</option>
                                                @endforeach
                              </select>
                              @error('credit_facilities')
                                <div class="text-danger">
                                  {{$message}}
                                </div>
                              @enderror
                            </div>
                          </div>
                        </div>
                </div>

               
         </div>



              <!-- /.box-body -->
              <div class="box-footer">
        
                <button type="submit" class="btn btn-info pull-right">Add</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

             </div>


             <div class="row">

<div class="box">
  <div class="box-header">
    <h3 class="box-title">Currencies List</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table class="table table-bordered table-striped">
      <thead>
      <tr>
      
        <th>Date</th>
        <th>Debit</th>
        <th>Credit</th>
      </tr>
      </thead>
      <tbody>
     
      </tbody>
      </table>
          <tfoot>
              <div style="margin-top:20px">
                  <div class="pull-right">
                                    </div>
              </div>
          </tfoot>
          
  </div>
  <!-- /.box-body -->
</div>
</div>

      <!-- /.row -->
    </section>
  <script>
 
// function validateReportform() {

// var isValid = true;




//     if ($("input#to_date").val() == "" || $("input#from_date").val() == "") {
//         isValid = false;
//         alert("Select date range");
//     }




// return isValid;


// }
  
</script>


@endsection


@section('scripts')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="{{asset('bower_components/datatables/js/jquery.datatables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables-bs/js/datatables.bootstrap.min.js')}}"></script>



@endsection
