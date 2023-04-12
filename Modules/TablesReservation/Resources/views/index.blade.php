@extends('layouts.template')
@section('title')
Tables Reservation
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Tables Reservation</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">CMS</li>
        <li class="breadcrumb-item active">Tables Reservation</li>
      </ol>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <div class="row">
          <h4 class="col-md-6">Tables Reservation</h4>
          <div class="col-md-6 text-end">
            <a href="{{url('admin/tables-reservation/create')}}" class="btn btn-success">+</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-hover table-bordered" id="slider" style="width:100%;">
            <thead class="text-center bg-primary text-white">
              <tr>
                <th>Name</th>
                <th>No of Guests</th>
                <th>Price</th>
                <th>Time From</th>
                <th>Time To</th>
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
<div id="">
  <div class="modal fade" id="mdl-show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Product Showcase Images</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="product-showcase-images-container">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
var roles_table = $('#slider').DataTable({
processing: true,
serverSide: true,
ajax: "{{url('admin/tables-reservation')}}",
buttons:[],
columns: [
{data: 'name', name: 'name',class:'text-center'},
{data: 'guests', name: 'guests',class:'text-center'},
{data: 'price', name: 'price',class:'text-center'},
{data: 'time_from', name: 'time_from',class:'text-center'},
{data: 'time_to', name: 'time_to',class:'text-center'},
{data: 'status', name: 'status', orderable: false, searchable: false ,class:'text-center'},
{data: 'action', name: 'action', orderable: false, searchable: false ,class:'text-center'},
]
});


});
</script>
@endsection