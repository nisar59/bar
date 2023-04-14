@extends('layouts.template')
@section('title')
Weakly Events 
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Weakly Events</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Weakly-Events</li>
        <li class="breadcrumb-item active">Weakly-Events</li>
      </ol>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <div class="row">
          <h4 class="col-md-6">Weakly Events </h4>
          <div class="col-md-6 text-end">
            <a href="{{url('admin/weaklyevents/create')}}" class="btn btn-success">+</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-hover table-bordered" id="weaklyevents" style="width:100%;">
            <thead class="text-center bg-primary text-white">
              <tr>
                <th>Image</th>
                <th>Description</th>
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
  var roles_table = $('#weaklyevents').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{url('admin/weaklyevents')}}",
              buttons:[],
              columns: [
                {data: 'image', name: 'image',class:'text-center', orderable: false, searchable: false ,class:'text-center'},
                {data: 'description', name: 'description',class:'text-center'},
                {data: 'status', name: 'status', orderable: false, searchable: false ,class:'text-center'},
                {data: 'action', name: 'action', orderable: false, searchable: false ,class:'text-center'},
            ]
          });
      });
</script>
@endsection
