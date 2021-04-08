@extends('layouts.auth')

@section('title')
    Login Page
@endsection
@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="{{url('/')}}"><b>EL-Diesel</b> App</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

     <form method="POST" action="{{ route('login') }}">
        @csrf
      <div class="form-group has-feedback">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    {{-- <span class="glyphicon glyphicon-envelope form-control-feedback"> --}}
                                        {{-- <strong>{{ $message }}</strong> --}}
                                    {{-- </span> --}}
                                    @enderror
      </div>
      <div class="form-group has-feedback">
         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">


                                @error('password')
                                    <span class="error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
               <input class="form-check-input" type="checkbox" name="remember" for="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
               Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

   {{-- @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    @endif --}}

  </div>

</div>
@endsection


<style>
.error{
    color: red;
}
</style>
