@extends('layouts.template')
@section('title')
Events
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Events</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Events</li>
        <li class="breadcrumb-item active">Events</li>
      </ol>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <div class="row">
          <h4 class="col-md-6">Events</h4>
          <div class="col-md-6 text-end">
            <a href="{{url('admin/events/create')}}" class="btn btn-success">+</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-hover table-bordered" id="events" style="width:100%;">
            <thead class="text-center bg-primary text-white">
              <tr>
                <th>Events</th>
                <th>Title</th>
                <th>Date</th>
                <th>Image</th>
                <th>More Information Link</th>
                <th>Buy Ticket Link</th>
                <th>Facebook Link</th>
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
  var roles_table = $('#events').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{url('admin/events')}}",
              buttons:[],
              columns: [
                {data: 'event_type', name: 'event_type',class:'text-center'},
                {data: 'title', name: 'title',class:'text-center'},
                {data: 'event_date', name: 'event_date',class:'text-center'},
                {data: 'image', name: 'image', orderable: false, searchable: false ,class:'text-center'},
                {data: 'info_link', name: 'info_link',class:'text-center'},
                {data: 'ticket_link', name: 'ticket_link',class:'text-center'},
                {data: 'facebook_link', name: 'facebook_link',class:'text-center'},
                
                {data: 'status', name: 'status', orderable: false, searchable: false ,class:'text-center'},
                {data: 'action', name: 'action', orderable: false, searchable: false ,class:'text-center'},
            ]
          });
      });
</script>
@endsection
