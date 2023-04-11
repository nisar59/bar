<!DOCTYPE html>
<html lang="en">
 <!-- head -->
 @include('include.head')
<body class="has-hero-intent basic-template">
 <!-- header -->
 @include('include.header')

 @yield('content')

<!-- Footer -->
 @include('include.footer')

	<!-- Footer script -->
  @include('include.footer_script')


</body>
</html>