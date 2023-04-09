@extends('layouts.template')
@section('title')
Product Showcase
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Product Showcase</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">CMS</li>
        <li class="breadcrumb-item active">Product Showcase</li>
      </ol>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <div class="row">
          <h4 class="col-md-6">Product Showcase</h4>
          <div class="col-md-6 text-end">
            <a href="{{url('product-showcase/create')}}" class="btn btn-success">+</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-hover table-bordered" id="slider" style="width:100%;">
            <thead class="text-center bg-primary text-white">
              <tr>
                <th>Name</th>
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
ajax: "{{url('product-showcase')}}",
buttons:[],
columns: [
{data: 'name', name: 'name',class:'text-center'},
{data: 'description', name: 'description',class:'text-center'},
{data: 'status', name: 'status', orderable: false, searchable: false ,class:'text-center'},
{data: 'action', name: 'action', orderable: false, searchable: false ,class:'text-center'},
]
});
$(document).on('click','.product-showcase-show',function () {

var images_data=$(this).data('images');
console.log(images_data);
var html='';
$.each(images_data,function(indx, vlu) {
        var img=vlu.image;
        html+=`<div class="row"><div class="col-md-12 m-1">
        <a class="btn btn-danger btn-sm position-absolute end-0" href="{{url('product-showcase/image/destroy/')}}/`+vlu.id+`">x</a>
        <img src="{{asset('images/product-showcase/')}}/`+img+`" class="w-100 border border-primary" />
        </div>
        </div>`      
});

$("#product-showcase-images-container").html(html);

$("#mdl-show").modal('show');
});
});
</script>
@endsection