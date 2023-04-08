@extends('layouts.template')
@section('title')
Menu
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Pages</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">CMS</li>
        <li class="breadcrumb-item active">Menu</li>
      </ol>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <div class="row">
          <h4 class="col-md-6">Menu</h4>
          <div class="col-md-6 text-end">
            <a href="{{url('menu/create')}}" class="btn btn-success">+</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-hover table-bordered" id="menu" style="width:100%;">
            <thead class="text-center bg-primary text-white">
              <tr>
                <th>Type</th>
                <th>Name</th>
                <th>Page</th>
                <th>URL</th>
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
  var roles_table = $('#menu').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{url('menu')}}",
              buttons:[],
              columns: [
                {data: 'type', name: 'type',class:'text-center'},
                {data: 'name', name: 'name',class:'text-center'},
                {data: 'page_slug', name: 'page_slug',class:'text-center'},
                {data: 'url', name: 'url',class:'text-center'},
                {data: 'status', name: 'status', orderable: false, searchable: false ,class:'text-center'},
                {data: 'action', name: 'action', orderable: false, searchable: false ,class:'text-center'},
            ]
          });
      });
</script>
@endsection
