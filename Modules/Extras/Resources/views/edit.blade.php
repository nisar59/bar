@extends('layouts.template')
@section('title')
Extras
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Extras</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Extras</li>
        <li class="breadcrumb-item active">Extras</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('admin/extras/update/'.$extra->id)}}" method="post">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Extras</h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Name</label>
                  <input type="" class="form-control" name="name" value="{{$extra->name}}" placeholder="Name">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Price</label>
                  <input type="number"/ min="0" class="form-control" value="{{$extra->price}}" name="price" placeholder="Price">
                </div>
              </div>
            </div>
            
          </div>
          <div class="row">
            <div class="col-md-12">
          <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control"  id="" cols="68" placeholder="Description " rows="5">{{$extra->description}}</textarea>
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