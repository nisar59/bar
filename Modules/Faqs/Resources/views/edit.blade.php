@extends('layouts.template')
@section('title')
FAQs
@endsection
@section('content')

<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">FAQs</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">FAQs</li>
        <li class="breadcrumb-item active">FAQs</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('admin/faqs/update/'.$faq->id)}}" method="post">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>FAQs</h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Title</label>
            <input type="" class="form-control" name="title" value="{{$faq->title}}" placeholder="Enter Title">
          </div>
           <div class="form-group mt-3">
            <label>Description</label>
            <textarea id="elm1" class="form-control" name="description">{{$faq->description}}</textarea>
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