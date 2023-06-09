@extends('layouts.template')
@section('title')
Social Media
@endsection
@section('content')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
@endsection

<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Social Media</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">CMS</li>
        <li class="breadcrumb-item active">Social Media</li>
      </ol>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <div class="row">
          <h4 class="col-md-6">Social Media</h4>
          <div class="col-md-6 text-end">
            <a href="{{url('admin/social-media/create')}}" class="btn btn-success">+</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-hover table-bordered" id="social-media" style="width:100%;">
            <thead class="text-center bg-primary text-white">
              <tr>
                <th>Name</th>
                <th>Link</th>
                <th>Icon</th>
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
var roles_table = $('#social-media').DataTable({
processing: true,
serverSide: true,
ajax: "{{url('admin/social-media')}}",
buttons:[],
columns: [
{data: 'name', name: 'name',class:'text-center'},
{data: 'link', name: 'link',class:'text-center'},
{data: 'icon', name: 'icon',class:'text-center'},
{data: 'status', name: 'status',class:'text-center'},
{data: 'action', name: 'action', orderable: false, searchable: false ,class:'text-center'},
]
});

});
</script>
@endsection