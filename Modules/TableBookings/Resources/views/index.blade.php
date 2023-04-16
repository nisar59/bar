@extends('layouts.template')
@section('title')
Table Bookings 
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Table Bookings</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Table Bookings</li>
        <li class="breadcrumb-item active">Table Bookings</li>
      </ol>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <div class="row">
          <h4 class="col-md-6">Table Bookings </h4>
          <div class="col-md-6 text-end">
            <a href="{{url('admin/weekly-events/create')}}" class="btn btn-success">+</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-hover table-bordered" id="weekly-events" style="width:100%;">
            <thead class="text-center bg-primary text-white">
              <tr>
                <th>Name</th>
                <th>Sitting</th>
                <th>Table</th>
                <th>Extra</th>
                <th>Booking Date</th>
                <th>Payment Status</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    //Roles table
    $(document).ready( function(){
  var roles_table = $('#weekly-events').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{url('admin/table-bookings')}}",
              buttons:[],
              columns: [
                {data: 'user_id', name: 'user_id',class:'text-center', orderable: false, searchable: false ,class:'text-center'},
                {data: 'sitting_id', name: 'sitting_id',class:'text-center'},
                {data: 'table_id', name: 'table_id',class:'text-center'},
                {data: 'extras_ids', name: 'extras_ids',class:'text-center'},
                {data: 'booking_date', name: 'booking_date',class:'text-center'},
                {data: 'payment_status', name: 'payment_status',class:'text-center'},
                {data: 'status', name: 'status', orderable: false, searchable: false ,class:'text-center'},
                {data: 'action', name: 'action', orderable: false, searchable: false ,class:'text-center'},
            ]
          });
      });
</script>
@endsection
