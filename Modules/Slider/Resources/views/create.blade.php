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
<form action="{{url('slider/store')}}" method="post" >
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Slider</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <label for="">Name</label>
              <input type="text" class="form-control" name="name" placeholder="Enter Name">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control"  id="" cols="68" placeholder="Enter Description " rows="5"></textarea>
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
