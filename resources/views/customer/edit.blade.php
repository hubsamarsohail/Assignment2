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
            <form class="form-horizontal" method="POST" action="{{route('customers.update', ['customer' => $customer->uuid])}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
              <div class="box-body">
              <div class="row">
                <div class="col-md-6 col-sm-12">
                              <div class="form-group">
                                <label for="vendor" class="control-label col-sm-3">Account Type</label>
                                <div class="col-sm-9">
                                  <input id="vendor" class="form-check-input" type="checkbox" name="vendor" data-toggle="toggle" data-style="ios" data-on="Vendor" data-off="Customer" {{$customer->vendor == 'true' || $customer->vendor == 'on' ? 'checked' : ''}}>
                                  @error('vendor')
                                <div class="text-danger">
                                  {{$message}}
                                </div>
                              @enderror
                                </div>
                              </div>
                    </div>
              </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="customer_name_english" class="col-sm-3 control-label">Customer Name English *</label>
                      <div class="col-sm-9">
                        <input type="text" name="customer_name_english" class="form-control" id="customer_name_english" placeholder="Customer Name English" value="{{$customer->customer_name_english ? $customer->customer_name_english : ''}}">
                        @error('customer_name_english')
                          <div class="text-danger">
                            {{$message}}
                          </div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="customer_name_arabic" class="col-sm-3 control-label">Customer Name Arabic</label>
                      <div class="col-sm-9">
                        <input type="text" name="customer_name_arabic" class="form-control" id="customer_name_arabic" placeholder="Customer Name Arabic" value="{{$customer->customer_name_arabic ? $customer->customer_name_arabic : ''}}">
                        @error('customer_name_arabic')
                        <div class="text-danger">
                          {{$message}}
                        </div>
                      @enderror
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact_person" class="col-sm-3 control-label">Contact Person</label>
                            <div class="col-sm-9">
                             <input type="text" name="contact_person" class="form-control" id="contact_person" placeholder="Contact Person" value="{{$customer->contact_person ? $customer->contact_person : ''}}">
                              @error('contact_person')
                                <div class="text-danger">
                                  Enter Customer's Contact Person
                                </div>
                              @enderror
                            </div>
                          </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="contact_number" class="col-sm-3 control-label">Contact Number</label>
                            <div class="col-sm-9">
                              <input type="text" name="contact_number" class="form-control" id="contact_number" placeholder="Phone Number" value="{{$customer->contact_number ? $customer->contact_number : ''}}">
                              @error('contact_number')
                                <div class="text-danger">
                                  {{$message}}
                                </div>
                              @enderror
                            </div>
                          </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                              <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" value="{{$customer->email ? $customer->email : ''}}">

                              @error('email')
                                <div class="text-danger">
                                  Enter Customer's Email
                                </div>
                              @enderror
                            </div>
                          </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="join_date" class="col-sm-3 control-label">Join Date</label>
                            <div class="col-sm-9">
                              <input type="date" name="join_date" class="form-control" id="join_date" placeholder="Phone Number" value="{{$customer->join_date ? $customer->join_date : ''}}" disabled>

                              @error('join_date')
                                <div class="text-danger">
                                  Enter Customer's Join Date
                                </div>
                              @enderror
                            </div>
                          </div>
                    </div>
                </div>

                  <div class="row">

                      <div class="col-md-6">

                        <div class="form-group">
                            <label for="address" class="col-sm-3 control-label">Address</label>
                            <div class="col-sm-9">
                              <textarea name="address" id="" cols="30" rows="2" class="form-control" placeholder="Addresss">{{$customer->address ? $customer->address : null}}</textarea>
                              @error('address')
                                <div class="text-danger">
                                  {{$message}}
                                </div>
                              @enderror
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">

                        <div class="form-group">
                            <label for="detailed_address" class="col-sm-3 control-label">Detailed Address</label>
                            <div class="col-sm-9">
                              <textarea name="detailed_address" id="" cols="30" rows="2" class="form-control" placeholder="Detailed Addresss">{{$customer->detailed_address ? $customer->detailed_address : null}}</textarea>
                              @error('detailed_address')
                                <div class="text-danger">
                                  {{$message}}
                                </div>
                              @enderror
                            </div>
                          </div>
                      </div>
                  </div>

                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="account_number" class="col-sm-3 control-label">Account Number</label>
                            <div class="col-sm-9">
                              <input type="text" name="account_number" class="form-control" id="account_number" placeholder="Account Number" value="{{$customer->account_number ? $customer->account_number : ''}}">
                              @error('account_number')
                                <div class="text-danger">
                                  {{$message}}
                                </div>
                              @enderror
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="credit_limit" class="col-sm-3 control-label">Credit Limit</label>
                            <div class="col-sm-9">
                              <input type="number" name="credit_limit" class="form-control" id="credit_limit" placeholder="Credit Limit" value="{{$customer->credit_limit ? $customer->credit_limit : 0}}">
                              @error('credit_limit')
                                <div class="text-danger">
                                  {{$message}}
                                </div>
                              @enderror
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                         <div class="form-group">
                            <label for="credit_facilities" class="col-sm-3 control-label">Credit Facilities</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="credit_facilities" id="credit_facilities">
                                <option value="">Select Credit Facility</option>
                                <option value="30" {{$customer->credit_facilities == 30 ? 'selected' : ''}}>30</option>
                                <option value="60" {{$customer->credit_facilities == 60 ? 'selected' : ''}}>60</option>
                                <option value="90" {{$customer->credit_facilities == 90 ? 'selected' : ''}}>90</option>
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
                            <label for="discount_category" class="col-sm-3 control-label">Discount Category</label>
                            <div class="col-sm-9">
                              <input type="number" name="discount_category" class="form-control" id="discount_category" placeholder="Discount Category" value="{{$customer->discount_category ? $customer->discount_category : 0}}">
                              @error('discount_category')
                                <div class="text-danger">
                                  {{$message}}
                                </div>
                              @enderror
                            </div>
                          </div>
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-6">
                         <div class="form-group">
                            <label for="vat_number" class="col-sm-3 control-label">VAT Number</label>
                            <div class="col-sm-9">
                              <input type="number" name="vat_number" class="form-control" id="vat_number" placeholder="VAT Number" value="{{$customer->vat_number ? $customer->vat_number : 0}}">
                              @error('vat_number')
                                <div class="text-danger">
                                  {{$message}}
                                </div>
                              @enderror
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                         <div class="form-group">
                            <label for="sales_man" class="col-sm-3 control-label">Salesman</label>
                            <div class="col-sm-9">
                              <input type="text" name="sales_man" class="form-control" id="sales_man" placeholder="Salesman" value="{{$customer->sales_man ? $customer->sales_man : ''}}">
                              @error('sales_man')
                                <div class="text-danger">
                                  {{$message}}
                                </div>
                              @enderror
                            </div>
                          </div>
                        </div>
                    </div>



                    <div class="row">
                    <div class="col-md-12">

                          <div class="col-md-6">
                              <div class="form-group">
                                <label for="blacklist" class="control-label col-sm-3">Blacklist</label>
                                <div class="col-sm-9">
                                  <input id="blacklist" class="form-check-input" type="checkbox" name="blacklist" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" {{$customer->blacklist == 'true' || $customer->blacklist == 'on' ? 'checked' : ''}}>
                                  @error('blacklist')
                                <div class="text-danger">
                                  {{$message}}
                                </div>
                              @enderror
                                </div>
                              </div>
                          </div>


                    </div>

                    </div>

                    </div>


                    {{-- <div class="form-group">
                        <label for="auto_generate" class="control-label col-xs-4 col-md-2">Auto Generate</label>
                        <div class="col-xs-10">
                          <input id="auto_generate" class="form-check-input" type="checkbox" name="auto_generate" data-toggle="toggle" data-style="ios">
                        </div>
                      </div> --}}

              <!-- /.box-body -->
              <div class="box-footer">
                {{-- <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-default">Cancel</button> --}}
                <button type="submit" class="btn btn-info pull-right">Update</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

             </div>

    </section>
    </section>



@endsection


@section('scripts')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="{{asset('bower_components/datatables/js/jquery.datatables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables-bs/js/datatables.bootstrap.min.js')}}"></script>

<script>
  $(function () {
    // $('#example2').DataTable({
    //   'paging'      : true,
    //   'lengthChange': false,
    //   'searching'   : false,
    //   'ordering'    : true,
    //   'info'        : true,
    //   'autoWidth'   : true
    // })

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
