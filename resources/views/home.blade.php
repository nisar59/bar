@extends('layouts.template')
@section('title')
Dashboard
@endsection
@section('content')
<!-- start page title -->
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Dashboard</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item active">Welcome to {{Settings()->portal_name}} Dashboard</li>
      </ol>
    </div>
  </div>
</div>
<!-- end page title -->
<div class="row">
</div>
@endsection
@section('js')
<script>
$(document).ready(function() {



  });




</script>
@endsection