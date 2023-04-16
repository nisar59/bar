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

 @yield('modal')
	<!-- Footer script -->
  @include('include.footer_script')

  @yield('js')


<script type="text/javascript">

@if (count($errors) > 0)
@foreach ($errors->all() as $error)
error("{{$error}}", 'Input error');
@endforeach
@elseif (Session::has('warning'))
warning("{{ Session::get('warning') }}");
@elseif (Session::has('success'))
success("{{ Session::get('success') }}");
@elseif (Session::has('error'))
error("{{ Session::get('error') }}");
@elseif (Session::has('info'))
info(`{{ Session::get('info') }}`);


@elseif (isset($warning))
warning("{{ $warning }}");
@elseif (isset($success))
success("{{ $success }}");
@elseif (isset($error))
error("{{ $error }}");
@elseif (isset($info))
info("{{ $info }}");

@else
@endif


</script>

</body>
</html>