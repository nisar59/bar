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
  <div class="col-xl-4 col-md-6">
    <div class="card mini-stat text-dark" style="background:#E6F2FE; border-top: 4px solid #F77C0C;">
      <div class="card-body">
        <div class="mb-4">
          <div class="float-start mini-stat-img me-4 text-white" style="background:#F77C0C;">
            <i class="fas fa-users fa-lg"></i>
          </div>
          <h5 class="fw-bold font-size-16 text-uppercase">Total Bookings </h5>
          <h4 class="fw-bold font-size-24">{{@number_format($total_bookings)}}</h4>
        </div>
        <div class="pt-2">
          <div class="float-end">
            <a href="{{url('admin/table-bookings')}}" class="text-dark"><i class="mdi mdi-arrow-right h5"></i></a>
          </div>
          <p class="text-dark mb-0 mt-1">Total Bookings</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-md-6">
    <div class="card mini-stat text-dark" style="background:#E5DEF0; border-top: 4px solid #006BA6;">
      <div class="card-body">
        <div class="mb-4">
          <div class="float-start mini-stat-img me-4 text-white" style="background:#006BA6">
            <i class="fas fa-user-check fa-lg"></i>
          </div>
          <h5 class="fw-bold font-size-16 text-uppercase text-dark">Active Bookings</h5>
          <h4 class="fw-bold font-size-24">{{@number_format($active_bookings)}}</h4>
        </div>
        <div class="pt-2">
          <div class="float-end">
            <a href="{{url('admin/table-bookings')}}" class="text-dark"><i class="mdi mdi-arrow-right h5"></i></a>
          </div>
          <p class="text-dark mb-0 mt-1">Active Bookings</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-md-6">
    <div class="card mini-stat text-dark" style="background:#D6EDD9; border-top: 4px solid #333547;">
      <div class="card-body">
        <div class="mb-4">
          <div class="float-start mini-stat-img me-4 text-white" style="background:#333547">
            <i class="fas fa-money-bill-alt fa-lg"></i>
          </div>
          <h5 class="fw-bold font-size-16 text-uppercase text-dark">Served Bookings</h5>
          <h4 class="fw-bold font-size-24">{{@number_format($served_bookings)}}</h4>
        </div>
        <div class="pt-2">
          <div class="float-end">
            <a href="{{url('admin/table-bookings')}}" class="text-dark"><i class="mdi mdi-arrow-right h5"></i></a>
          </div>
          <p class="text-dark mb-0 mt-1">Served Bookings</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script>
$(document).ready(function() {



  });




</script>
@endsection