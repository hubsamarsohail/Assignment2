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
        Products
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
              <h3 class="box-title">Add Product</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{route('product.store')}}">
                @csrf
              <div class="box-body">

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name" class="col-sm-3 control-label">Name</label>
                      <div class="col-sm-9">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Product Name" value="{{old('name') ? old('name') : ''}}">
                        @error('name')
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
                        <div class="col-sm-3"></div>
                      <div class="col-sm-9">
                        <div class="checkbox icheck">
                        <label>
                            <input class="form-check-input" type="checkbox" name="under_vat" for="under_vat" id="under_vat" {{ old('under_vat') ? 'checked' : '' }}>
                            Under VAT
                        </label>
                    </div>
                      </div>
                    </div>
                  </div>
                </div>



{{--
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="brand" class="col-sm-3 control-label">Brand</label>
                      <div class="col-sm-9">
                        <input type="text" name="brand" class="form-control" id="brand" placeholder="Vechile Brand Name" value="{{old('brand') ? old('brand') : ''}}">
                        @error('brand')
                          <div class="text-danger">
                            {{$message}}
                          </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div> --}}

                {{-- <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="capacity" class="col-sm-3 control-label">Vechile Capacity</label>
                            <div class="col-sm-9">
                             <input type="text" name="capacity" class="form-control" id="capacity" placeholder="Vechile Capacity" value="{{old('capacity') ? old('capacity') : ''}}">
                              @error('capacity')
                                <div class="text-danger">
                                  Enter Vechile's Capacity
                                </div>
                              @enderror
                            </div>
                          </div>
                    </div>
                </div> --}}

                 {{-- <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="num_compartments" class="col-sm-3 control-label">Number of Compartments</label>
                            <div class="col-sm-9">
                              <input type="num_compartments" name="num_compartments" class="form-control" id="num_compartments" placeholder="Number of Compartments" value="{{old('num_compartments') ? old('num_compartments') : ''}}">
                              @error('num_compartments')
                                <div class="text-danger">
                                  Enter Number of Compartment in Vechile
                                </div>
                              @enderror
                            </div>
                          </div>
                    </div>
                </div> --}}


                {{-- <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="plate_number" class="col-sm-3 control-label">Plate Number</label>
                            <div class="col-sm-9">
                              <input type="plate_number" name="plate_number" class="form-control" id="plate_number" placeholder="Vechile Plate Number" value="{{old('plate_number') ? old('plate_number') : ''}}">

                              @error('plate_number')
                                <div class="text-danger">
                                  Plate Number is Required
                                </div>
                              @enderror
                            </div>
                          </div>
                    </div>
                </div> --}}
                    </div>

              <!-- /.box-body -->
              <div class="box-footer">
                {{-- <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-default">Cancel</button> --}}
                <button type="submit" class="btn btn-info pull-left">Add Products</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

             </div>
      <div class="row">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Product's List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Product Name</th>
                  <th>Available Quantity</th>
                  <th>Under VAT</th>
                  {{-- <th>Plate Number</th>
                  <th>Capacity</th>
                  <th>No Compartments</th> --}}
                </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr class="single-row" data-target="{{$product->product_id}}">
                      <td>{{$product->id}}</td>
                      <td>{{$product->name}}</td>
                      <td>{{$product->quantity}}</td>
                      <td>{{ucfirst($product->under_vat == 'on' ? 'YES' : 'NO')}}</td>
                      {{-- <td>{{$product->plate_number}}</td>
                      <td>{{$product->capacity}}</td>
                      <td>{{$product->num_compartments}}</td> --}}
                    </tr>
                  @endforeach
                </tbody>
                </table>
                    <tfoot>
                        <div style="margin-top:20px">
                            <div class="pull-right">
                                {{$products->links()}}
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
        });

         $('.single-row').on('click', function(evt){
            evt.preventDefault();
            const target= evt.currentTarget.attributes['data-target'].value;
            window.location = `/product/${target}`;
        })
    });


</script>
{{-- <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> --}}
{{-- <script src="/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script> --}}
{{-- <script src="/bower_components/fastclick/lib/fastclick.js"></script> --}}
{{-- <script src="/js/adminlte.min.js"></script> --}}

@endsection
