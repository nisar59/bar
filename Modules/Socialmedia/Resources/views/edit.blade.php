@extends('layouts.template')
@section('title')
Social Media
@endsection
@section('content')
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
<form action="{{url('admin/social-media/update/'.$social_media->id)}}" method="post" >
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Social Media</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <label for="">Name</label>
              <input type="text" class="form-control" name="name" value="{{$social_media->name}}" placeholder="Enter Name">
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label>Link</label>
                <input type="url" class="form-control" name="link" value="{{$social_media->link}}" placeholder="Enter Link">
              </div>
            </div>
          </div>
          <div class="row">
            <dov class="col-md-6">
            <div class="form-group">
              <label>Icone</label>
              <input type="" class="form-control" name="icone" value="{{$social_media->icone}}" placeholder="Enter Icone">
            </div>
            </dov>
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