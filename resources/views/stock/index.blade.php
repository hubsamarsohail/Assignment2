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
        Stocks
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
              <h3 class="box-title">Add Stock</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{route('stock.store')}}">
                @csrf
              <div class="box-body">

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name" class="col-sm-3 control-label">Name</label>
                      <div class="col-sm-9">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Stock Name" value="{{old('name') ? old('name') : ''}}">
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
                            <label for="location" class="col-sm-3 control-label">Stock Location</label>
                            <div class="col-sm-9">
                             <input type="text" name="location" class="form-control" id="location" placeholder="Stock Location" value="{{old('location') ? old('location') : ''}}">
                              @error('location')
                                <div class="text-danger">
                                  Enter Stock Location
                                </div>
                              @enderror
                            </div>
                          </div>
                    </div>
                </div>

                    </div>

              <!-- /.box-body -->
              <div class="box-footer">
                {{-- <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-default">Cancel</button> --}}
                <button type="submit" class="btn btn-info pull-left">Add Stock</button>
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
                  <th>ID</th>
                  <th>Stock Name</th>
                  <th>Stock Location</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($stocks as $stock)
                    <tr class="single-row" data-target="{{$stock->stock_id}}">
                      <td>{{$stock->id}}</td>
                      <td>{{$stock->name}}</td>
                      <td>{{$stock->location}}</td>
                    </tr>
                  @endforeach
                </tbody>
                </table>
                    <tfoot>
                        <div style="margin-top:20px">
                            <div class="pull-right">
                                {{$stocks->links()}}
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
            window.location = `/stock/${target}`;
        })

    });


</script>
{{-- <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> --}}
{{-- <script src="/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script> --}}
{{-- <script src="/bower_components/fastclick/lib/fastclick.js"></script> --}}
{{-- <script src="/js/adminlte.min.js"></script> --}}

@endsection
