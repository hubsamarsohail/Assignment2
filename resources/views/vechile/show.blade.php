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
        Vechiles
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
              <h3 class="box-title">Add Vechile</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {{-- <form class="form-horizontal" method="POST" action="{{route('vechile.store')}}" enctype="multipart/form-data"> --}}
                {{-- @csrf --}}
              <div class="box-body">

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name" class="col-sm-3 control-label">Name</label>
                      <div class="col-sm-9">
                        <p> {{$vechile->name}} </p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="brand" class="col-sm-3 control-label">Brand</label>
                      <div class="col-sm-9">
                        <p>{{$vechile->brand }}</p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="capacity" class="col-sm-3 control-label">Vechile Capacity</label>
                            <div class="col-sm-9">
                            <p>{{$vechile->capacity}}</p>
                            </div>
                          </div>
                    </div>
                </div>

                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="num_compartments" class="col-sm-3 control-label">Number of Compartments</label>
                            <div class="col-sm-9">
                              <p> {{ $vechile->num_compartments }} </p>
                            </div>
                          </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="plate_number" class="col-sm-3 control-label">Plate Number</label>
                            <div class="col-sm-9">
                              <p>{{$vechile->plate_number}}</p>
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
                {{-- <button type="submit" class="btn btn-info pull-left">Add Vechile</button> --}}

                <div class="pull-right">

                    <form action="{{route('vechile.destroy', ['vechile' => $vechile->vechile_id])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
                <div class="pull-right" style="margin-right: 20px">
                    <form action="{{route('vechile.edit',['vechile' => $vechile->vechile_id])}}" method="POST">
                        @method('GET')
                        @csrf
                        <button type="submit" class="btn btn-info">Edit</button>
                    </form>
                </div>
              </div>
              <!-- /.box-footer -->
            {{-- </form> --}}
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




    });


</script>
{{-- <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> --}}
{{-- <script src="/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script> --}}
{{-- <script src="/bower_components/fastclick/lib/fastclick.js"></script> --}}
{{-- <script src="/js/adminlte.min.js"></script> --}}

@endsection
