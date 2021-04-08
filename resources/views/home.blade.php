@extends('layouts.app')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home Page
        <small>Homepage of El-Diesel</small>
      </h1>
      {{-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol> --}}
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div id="main-page-cover">
            <img src="{{asset('img/photo1.png')}}" alt="Home Page Cover Photo">
        </div>
    </section>
    <!-- /.content -->



</div>


@endsection


@section("styles")

<style>
#main-page-cover{
    height: 600px;
    width: 100%;
}

#main-page-cover img{
    width: inherit;
    height: inherit
}

</style>

@endsection
