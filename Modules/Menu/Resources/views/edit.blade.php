@extends('layouts.template')
@section('title')
Menu
@endsection
@section('content')

<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Menu</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">CMS</li>
        <li class="breadcrumb-item active">Menu</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('menu/update/'.$menu->id)}}" method="post">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Menu</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" value="{{$menu->name}}" name="name" placeholder="Enter Name">
          </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
            <label>Url</label>
            <input type="url" class="form-control" value="{{$menu->url}}" name="url" placeholder="Enter Url">
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