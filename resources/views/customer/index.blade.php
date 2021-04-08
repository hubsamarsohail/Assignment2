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
                <div class="col-md-6 col-sm-12">
                              <div class="form-group">
                                <label for="vendor" class="control-label col-sm-3">Account Type</label>
                                <div class="col-sm-9">
                                  <input id="vendor" class="form-check-input" type="checkbox" name="vendor" data-toggle="toggle" data-style="ios" data-on="Vendor" data-off="Customer" {{old('vendor') == 'true' || old('vendor') == 'on' ? 'checked' : ''}}>
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
                        <input type="text" name="customer_name_english" class="form-control" id="customer_name_english" placeholder="Customer Name English" value="{{old('customer_name_english') ? old('customer_name_english') : ''}}">
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
                        <input type="text" name="customer_name_arabic" class="form-control" id="customer_name_arabic" placeholder="Customer Name Arabic" value="{{old('customer_name_arabic') ? old('customer_name_arabic') : ''}}">
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
                             <input type="text" name="contact_person" class="form-control" id="contact_person" placeholder="Contact Person" value="{{old('contact_person') ? old('contact_person') : ''}}">
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
                              <input type="text" name="contact_number" class="form-control" id="contact_number" placeholder="Phone Number" value="{{old('contact_number') ? old('contact_number') : ''}}">
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
                              <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" value="{{old('email') ? old('email') : ''}}">

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
                              <input type="date" name="join_date" class="form-control" id="join_date" placeholder="Phone Number" value="{{old('join_date') ? old('join_date') : ''}}">

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
                              <textarea name="address" id="" cols="30" rows="2" class="form-control" placeholder="Addresss">{{old('address') ? old('address') : null}}</textarea>
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
                              <textarea name="detailed_address" id="" cols="30" rows="2" class="form-control" placeholder="Detailed Addresss">{{old('detailed_address') ? old('detailed_address') : null}}</textarea>
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
                              <input type="text" name="account_number" class="form-control" id="account_number" placeholder="Account Number" value="{{old('account_number') ? old('account_number') : ''}}">
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
                              <input type="number" name="credit_limit" class="form-control" id="credit_limit" placeholder="Credit Limit" value="{{old('credit_limit') ? old('credit_limit') : 0}}">
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
                                <option value="30" {{old('credit_facilities') == 30 ? 'selected' : ''}}>30</option>
                                <option value="60" {{old('credit_facilities') == 60 ? 'selected' : ''}}>60</option>
                                <option value="90" {{old('credit_facilities') == 90 ? 'selected' : ''}}>90</option>
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
                              <input type="number" name="discount_category" class="form-control" id="discount_category" placeholder="Discount Category" value="{{old('discount_category') ? old('discount_category') : 0}}">
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
                              <input type="number" name="vat_number" class="form-control" id="vat_number" placeholder="VAT Number" value="{{old('vat_number') ? old('vat_number') : 0}}">
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
                              <input type="text" name="sales_man" class="form-control" id="sales_man" placeholder="Salesman" value="{{old('sales_man') ? old('sales_man') : ''}}">
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
                                  <input id="blacklist" class="form-check-input" type="checkbox" name="blacklist" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" {{old('blacklist') == 'true' || old('blacklist') == 'on' ? 'checked' : ''}}>
                                  @error('blacklist')
                                <div class="text-danger">
                                  {{$message}}
                                </div>
                              @enderror
                                </div>
                              </div>
                          </div>

                          <input type="file" accept='image/*' name="profile_pics" id="profile" style="position: absolute; z-index: -1; top: -100px;" >
                        <div class="col-md-6">
                            <div class="form-group">
                                {{-- <label for="item_name" class="col-xs-2 col-md-1 control-label">Note</label> --}}
                                <label for="free_of_charge" class="control-label col-sm-3">Photo</label>
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
                <button type="submit" class="btn btn-info pull-right">Add</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

             </div>
      <div class="row">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Customer's List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Customer ID</th>
                  <th>Customer Name</th>
                  <th>Customer Name Arabic</th>
                  <th>Account Number</th>
                  <th>Contact Number</th>
                  <th>Contact Person</th>
                  <th>Type</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                    <tr class="single-row" data-target="{{$customer->uuid}}">
                      <td>{{$customer->id}}</td>
                      <td>{{$customer->customer_name_english}}</td>
                      <td>{{$customer->customer_name_arabic}}</td>
                      <td>{{$customer->account_number}}</td>
                      <td>{{$customer->contact_number}}</td>
                      <td>{{$customer->contact_person}}</td>
                      <td>{{$customer->vendor == 'false' ? 'Customer' : 'Vendor'}}</td>
                    </tr>
                  @endforeach
                </tbody>
                </table>
                    <tfoot>
                        <div style="margin-top:20px">
                            <div class="pull-right">
                                {{$customers->links()}}
                            </div>
                        </div>
                    </tfoot>
            </div>
            <!-- /.box-body -->
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
