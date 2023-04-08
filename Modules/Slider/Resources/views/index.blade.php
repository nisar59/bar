@extends('layouts.template')
@section('title')
Slider
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Slider</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">CMS</li>
        <li class="breadcrumb-item active">Slider</li>
      </ol>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <div class="row">
          <h4 class="col-md-6">Slider</h4>
          <div class="col-md-6 text-end">
            <a href="{{url('slider/create')}}" class="btn btn-success">+</a>
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
          <h5 class="modal-title" id="exampleModalLabel">Add Images</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <a href="javascript:void(0);" class="add_button float-end btn btn-success mt-4" title="Add field">+</a>
          </div>
          <div class="field_wrapper">
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Add Image</label>
                <input type="file" class="form-control" name="image">
              </div>
            </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
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
ajax: "{{url('slider')}}",
buttons:[],
columns: [
{data: 'name', name: 'name',class:'text-center'},
{data: 'description', name: 'description',class:'text-center'},
{data: 'status', name: 'status', orderable: false, searchable: false ,class:'text-center'},
{data: 'action', name: 'action', orderable: false, searchable: false ,class:'text-center'},
]
});
$(document).on('click','.slider-show',function () {
var id=$(this).data('id');
$("#mdl-show").modal('show');
});
});
$(document).ready(function(){
var maxField = 10;
var addButton = $('.add_button');
var wrapper = $('.field_wrapper');
var fieldHTML = '<div class="row"><div class="col-md-10 mt-1"><input type="file" class="form-control" name="image"></div><div class="col-md-2 mt-1"><button class="btn btn-danger remove_button">x</button</div></div>';
var x = 1;
$(addButton).click(function(){
if(x < maxField){
x++;
$(wrapper).append(fieldHTML);
}
});

$(wrapper).on('click', '.remove_button', function(e){
e.preventDefault();
$(this).parent('div').remove();
x--;
});
});
</script>
@endsection