@extends('layouts.template')
@section('title')
Edit Bottomless-Brunch 
@endsection
@section('content')

<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Bottomless-Brunch</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Bottomless-Brunch</li>
        <li class="breadcrumb-item active">Bottomless-Brunch</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('admin/brunch/update/'.$brunch->id)}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Bottomless-Brunch</h4>
        </div>
        <div class="card-body">
          <div class="row">
        <div class="form-group col-md-6">
          <label>Image</label>
          <input type="file" class="form-control" name="image" id="image" onchange="document.getElementById('image-display').src = window.URL.createObjectURL(this.files[0])">
        </div>
        <div class="form-group col-md-6">
          <img src="{{url('public/images/brunch/'.$brunch->image)}}" class="image-display float-end" id="image-display" width="100" height="100">
        </div>
        </div>
          <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control"  id="" cols="68" placeholder="Enter Description " rows="5">{{$brunch->description}}</textarea>
          </div>
          <div class="form-group">
            <label>Link</label>
            <input type="link" class="form-control" value="{{$brunch->link}}" name="link" placeholder="Enter Url">
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