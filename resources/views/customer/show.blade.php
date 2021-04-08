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
        Customers / Vendors
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
              <h3 class="box-title">Add Customers / Vendors</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{route('customers.store')}}" enctype="multipart/form-data">
                @csrf
              <div class="box-body">

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <p for="customer_name_english" class="col-sm-5 control-label">Customer Name English* : </p>
                      <div class="col-sm-7">
                        <p>{{$customer->customer_name_english}}</p>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <p for="customer_name_arabic" class="col-sm-5 control-label">Customer Name Arabic: </p>
                      <div class="col-sm-7">
                        <p>{{$customer->customer_name_arabic}}</p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <p for="contact_person" class="col-sm-5 control-label">Contact Person: </p>
                            <div class="col-sm-7">
                             <p>{{$customer->contact_person}}</p>
                            </div>
                          </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <p for="contact_number" class="col-sm-5 control-label">Contact Number: </p>
                            <div class="col-sm-7">
                              <p>{{$customer->contact_number}}</p>
                            </div>
                          </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <p for="email" class="col-sm-5 control-label">Email: </p>
                            <div class="col-sm-7">
                              <p>{{$customer->email}}</p>
                            </div>
                          </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <p for="join_date" class="col-sm-5 control-label">Join Date: </p>
                            <div class="col-sm-7">
                              <p>{{$customer->join_date}}</p>
                            </div>
                          </div>
                    </div>
                </div>

                  <div class="row">

                      <div class="col-md-6">

                        <div class="form-group">
                            <p for="address" class="col-sm-5 control-label">Address: </p>
                            <div class="col-sm-7">
                              <p>{{$customer->address}}</p>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">

                        <div class="form-group">
                            <p for="detailed_address" class="col-sm-5 control-label">Detailed Address: </p>
                            <div class="col-sm-7">
                              <p>{{$customer->detailed_address}}</p>
                            </div>
                          </div>
                      </div>
                  </div>

                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <p for="account_number" class="col-sm-5 control-label">Account Number: </p>
                            <div class="col-sm-7">
                              <p>{{$customer->account_number}}</p>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <p for="credit_limit" class="col-sm-5 control-label">Credit Limit: </p>
                            <div class="col-sm-7">
                              <p>{{$customer->credit_limit}}</p>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                         <div class="form-group">
                            <p for="credit_facilities" class="col-sm-5 control-label">Credit Facilities: </p>
                            <div class="col-sm-7">
                              <p>{{$customer->credit_facilities}}</p>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                         <div class="form-group">
                            <p for="discount_category" class="col-sm-5 control-label">Discount Category: </p>
                            <div class="col-sm-7">
                              <p>{{$customer->discount_category}}</p>
                            </div>
                          </div>
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-6">
                         <div class="form-group">
                            <p for="vat_number" class="col-sm-5 control-label">VAT Number: </p>
                            <div class="col-sm-7">
                              <p>{{$customer->vat_number}}</p>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                         <div class="form-group">
                            <p for="sales_man" class="col-sm-5 control-label">Salesman: </p>
                            <div class="col-sm-7">
                              <p>{{$customer->sales_man}}</p>
                            </div>
                          </div>
                        </div>
                    </div>



                    <div class="row">
                    <div class="col-md-12">
                         <div class="col-md-6 col-sm-12">
                              <div class="form-group">
                                <p for="vendor" class="control-label col-sm-5">Account Type: </p>
                                <div class="col-sm-7">
                                    <p>{{$customer->vendor == 'true' ? 'Vendor' : 'Customer'}}</p>
                                </div>
                              </div>
                         </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                <p for="blacklist" class="control-label col-sm-5">Blacklist: </p>
                                <div class="col-sm-7">
                                  <p>{{$customer->blacklikst ? 'Blacklisted' : 'No'}}</p>
                                </div>
                              </div>
                          </div>


                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <p for="item_name" class="col-xs-2 col-md-1 control-label">Note: </p>
                                <p for="free_of_charge" class="control-label col-sm-5">Photo: </p>
                            <div class="col-sm-9">
                              <div style="width:30%; height: 120px; border: 2px dashed gray; text-align:center; box-sizing:border-box; cursor:pointer;" id="upload_pics" >
                                <img src="{{asset('img/avatar.png')}}" alt="Display Picture" style="height:inherit; border-radius: 50%; padding: 10px;" >
                                @error('profile_pics')
                                <div class="text-danger">
                                  {{$message}}
                                </div>
                              @enderror
                              </div>
                            </div>
                        </div>

                      </div> --}}

                    </div>

                    </div>

                    </div>


                    {{-- <div class="form-group">
                        <p for="auto_generate" class="control-label col-xs-4 col-md-2">Auto Generate: </p>
                        <div class="col-xs-10">
                          <input id="auto_generate" class="form-check-input" type="checkbox" name="auto_generate" data-toggle="toggle" data-style="ios">
                        </div>
                      </div> --}}

              <!-- /.box-body -->

              <div class="box-footer clearfix clear">
                {{-- <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-default">Cancel</button> --}}
                <div class="pull-right">

                    <form action="{{route('customers.destroy', ['customer' => $customer->uuid])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
                <div class="pull-right" style="margin-right: 20px">
                    <form action="{{route('customers.edit',['customer' => $customer->uuid])}}" method="POST">
                        @method('GET')
                        @csrf
                        <button type="submit" class="btn btn-info">Edit</button>
                    </form>
                </div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

             </div>
      <!-- /.row -->
    </section>
    </section>



@endsection


@section('scripts')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="{{asset('bower_components/datatables/js/jquery.datatables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables-bs/js/datatables.bootstrap.min.js')}}"></script>

<script>
  $(function () {

        $('#example1').DataTable({
        'autoWidth': true
        })

        $('#upload_pics').on('click',(evt)=>{
            evt.stopPropagation();
            evt.preventDefault();

            $('#profile').trigger('click');
        });


        $('.single-row').on('click', function(evt){
            evt.preventDefault();
            const target= evt.currentTarget.attributes['data-target'].value;
            window.location = `/customers/${target}`;
        })

    });


</script>
{{-- <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> --}}
{{-- <script src="/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script> --}}
{{-- <script src="/bower_components/fastclick/lib/fastclick.js"></script> --}}
{{-- <script src="/js/adminlte.min.js"></script> --}}

@endsection
