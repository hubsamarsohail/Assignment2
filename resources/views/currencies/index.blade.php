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
      Currencies 
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
              <h3 class="box-title">Add Currencies</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{route('currencies.store')}}" enctype="multipart/form-data">
                @csrf
              <div class="box-body">
              
              
             

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact_person" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-9">
                             <input type="text" name="name" class="form-control" id="name" placeholder="Enter Currency Name" value="{{old('name') ? old('name') : ''}}">
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
                            <label for="contact_number" class="col-sm-3 control-label">Currency Rate</label>
                            <div class="col-sm-9">
                              <input type="text" name="rate" class="form-control" id="rate" placeholder="Enter Rate" value="{{old('rate') ? old('rate') : ''}}">
                              @error('rate')
                                <div class="text-danger">
                                    Enter Rate
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
                
                  <th>Name</th>
                  <th>Rate</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($currencies as $currency)
            
                      <td>{{$currency->id}}</td>
                      <td>{{$currency->name}}</td>
                      <td>{{$currency->rate}}</td>
                      

                    </tr>
                  @endforeach
                </tbody>
                </table>
                    <tfoot>
                        <div style="margin-top:20px">
                            <div class="pull-right">
                            {{$currencies->links()}}
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



@endsection
