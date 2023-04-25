<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{Settings()->portal_name}} - @yield('title')</title>
	<link rel="stylesheet" href="{{asset('assetss/css/bootstrap.css')}}">	
	<link rel="stylesheet" href="{{asset('assetss/bootstrap-datepicker/css/bootstrap-datepicker.css')}}">
	<link rel="stylesheet" href="{{asset('assets/izitoast/css/iziToast.min.css')}}">
	<link rel="stylesheet" href="{{asset('assetss/css/style.css')}}">
  	<link rel="icon" href="{{asset('img/settings/'.Settings()->website_favicon)}}" type="image/x-icon">
  	<link rel="shortcut icon" href="{{asset('img/settings/'.Settings()->website_favicon)}}" type="image/x-icon">
	@yield('css')
</head>
