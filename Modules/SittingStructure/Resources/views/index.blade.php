@extends('layouts.template')
@section('title')
Sitting Structure
@endsection
@section('css')
<style>
.double-dashed-border{
border:3px dashed;
outline:3px dashed;
outline-offset:-10px;
border-radius: 5px;
}
.outline-success{
outline-color: #02a499;
}
.outline-warning{
outline-color: orange;
}
.btn-remove{
  display: none;
}
.sitting-table-container:hover .btn-remove{
  display: block;
}
</style>
@endsection
@section('content')
@php
@endphp
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Sitting Structure</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">CMS</li>
        <li class="breadcrumb-item active">sitting Structure</li>
      </ol>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <div class="row">
          <h4 class="col-md-6">Sitting Map</h4>
        </div>
      </div>
      <div class="card-body">
        <form action="{{url('admin/sitting-structure/store/')}}" method="post" class="row justify-content-center" enctype="multipart/form-data" id="sitting-form">
          @csrf
          <div class="col-md-12 pt-2 pb-2 double-dashed-border" style="height:50vh;" id="map-container">
            <img src="@if($data->map!=null) {{asset('images/sitting-structure/'.$data->map)}} @else {{asset('img/images.png')}} @endif" alt="" class="h-100 w-100">
          </div>
          <input type="file" hidden name="map" id="map">
        </form>
      </div>
    </div>
  </div>
    <div class="col-md-6">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <div class="row">
          <h4 class="col-md-6">Sitting Tables</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="row">

          @foreach($data->tables as $table)

          <div class="sitting-table-container col-md-4 col-sm-6 p-1 position-relative text-center" style="height: 105px;" >
            <a class="position-absolute end-0 btn-remove btn btn-sm btn-danger" href="{{url('admin/sitting-structure/table/destroy/'.$table->id)}}" style="z-index: 999;">x</a>
            <div data-table="{{json_encode($table)}}" class="edit-sitting-table p-2 w-100 h-100 d-flex justify-content-center align-items-center flex-column double-dashed-border @if($table->status) border-success outline-success @else border-warning outline-warning @endif">
              <p class="fw-bold m-0 p-0 text-break overflow-hidden">{{$table->name}}</p>
              <p class="m-0 p-0">{{$table->guests}}</p>
            </div>
          </div>

          @endforeach

          <div class="col-md-4 col-sm-6 p-1 text-center d-flex justify-content-center align-items-center" style="height:105px;">
            <a class="w-100" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#sitting-tables-modal">
              <div class="p-4 pe-auto w-100 double-dashed-border" >
                <p class="m-2 p-0">+</p>
              </div></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
  @section('modal')
  @include('sittingstructure::create');

<!-- Modal -->
<div class="modal fade" id="sitting-table-edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="sitting-table-edit-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="sitting-table-edit-ModalLabel">Sitting Table</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Table Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Table Name">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">No of Guests</label>
                <input type="number" min="1" class="form-control" name="guests" id="guests" placeholder="No of Guests">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Status</label>
                  <select name="status" class="form-control d-block" id="status">
                    <option value="">select</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
              </div>
            </div>


          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>


  @endsection



  @section('js')
  <script type="text/javascript">
  $(document).ready( function(){
      $(document).on('click','#map-container', function(){
          $('#map').trigger('click');
      });
      
      $(document).on('change','#map', function(){
          $('#sitting-form').submit();
      });


      $(document).on('click','.edit-sitting-table', function(){
          var data=$(this).data('table');

          $("#sitting-table-edit-modal").find('form').attr('action', "{{url('admin/sitting-structure/table/update/')}}/"+data.id);

          $("#sitting-table-edit-modal").find('#name').val(data.name);
          $("#sitting-table-edit-modal").find('#guests').val(data.guests);
          $("#sitting-table-edit-modal").find('#status').val(data.status);
          $("#sitting-table-edit-modal").modal('show');


      });

  });
  </script>
  @endsection