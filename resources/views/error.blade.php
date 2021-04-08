<!DOCTYPE html>
<html lang="en">
<head>
<title>EL_DIESEL | Error Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="404 Error Page" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- font files -->
<link href="//fonts.googleapis.com/css?family=Heebo:100,300,400,500,700,800,900" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Rancho" rel="stylesheet">
<!-- /font files -->
<!-- css files -->
<link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
<!-- /css files -->
<body>
<div class="agileits-main">
	<a href="#"><h1><span>404</span>{{env('APP_NAME')}}</h1></a>
	<div class="w3ls-container text-center">
        <div class="w3layouts-image text-center">
            <img src="{{asset('images/board.png')}}" alt="" />
            <h2 class="header-w3ls">404</h2>
		</div>
        <h3 class="img-txt">Oops, you've encountered an error!</h3>
        {{-- <br /><br /> --}}
		<p>Looks like the page you are  trying to visit doesn't exist.</p>
		<div class="agileits-link">
			<a href="{{route('home')}}">take me home</a>
		</div>
	</div>
	{{-- <div class="w3ls-footer">
		<p> &copy; 2017 404 Error. All Rights Reserved | Design by <a href="http://w3layouts.com" target="=_blank">W3layouts</a></p>
	</div> --}}

</div>
</body>
</html>
