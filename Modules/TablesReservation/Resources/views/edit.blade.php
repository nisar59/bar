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
<form action="{{url('admin/tables-reservation/update/'.$data->id)}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Tables Reservation</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <label for="">Name</label>
              <input type="text" class="form-control" name="name" value="{{old('name', $data->name)}}" placeholder="Enter Name">
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>No of Guests</label>
                <input type="number" class="form-control" min="1" value="{{old('guests', $data->guests)}}" name="guests" placeholder="No of Guests">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Price</label>
                <input type="number" class="form-control" min="1" value="{{old('price', $data->price)}}" name="price" placeholder="Price">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Time From</label>
                <input type="time" class="form-control" value="{{old('time_from', $data->time_from)}}" name="time_from">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Time To</label>
                <input type="time" class="form-control" value="{{old('time_to', $data->time_to)}}" name="time_to">
              </div>
            </div>



          </div>
        </div>
        <div class="card-footer text-end">
          <button class="btn btn-primary mr-1" type="submit">Submit</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
@section('js')
<script type="text/javascript">
$(document).ready(function () {
  

});
</script>
@endsection