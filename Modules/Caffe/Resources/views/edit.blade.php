@extends('layouts.template')
@section('title')
Edit Caffe Menu
@endsection
@section('content')

<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Caffe Menu</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Caffe Menu</li>
        <li class="breadcrumb-item active">Caffe Menu</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('admin/caffe/update/'.$caffe->id)}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Caffe Menu</h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Title</label>
            <input type="" class="form-control" name="title" value="{{$caffe->title}}" placeholder="Enter Title">
          </div>
          
          <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control"id=""  cols="68" placeholder="Enter Description " rows="5">{{$caffe->description}}</textarea>
          </div>
          <div class="form-group">
            <label>Link</label>
            <input type="link" class="form-control"value="{{$caffe->link}}" name="link" placeholder="Enter Url">
          </div>
          <div class="form-group">
            <label>File /Upload Pdf File</label>
            <input type="file" class="form-control mb-2"  name="file" placeholder="Enter Image">
            <span ><b>{{$caffe->file}}</b></span>
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