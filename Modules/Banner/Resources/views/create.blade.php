@extends('layouts.template')
@section('title')
Banner
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Banner</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">CMS</li>
        <li class="breadcrumb-item active">Banner</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('admin/banner/store')}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Banner</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control"  name="name" placeholder="Enter name">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Heading (optional)</label>
                <input type="text" class="form-control"  name="heading" placeholder="Enter heading (optional)">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Sub Heading (optional)</label>
                <input type="text" class="form-control"  name="sub_heading" placeholder="Enter sub heading (optional)">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6  mt-1">
              <div class="form-group">
                <label>Link (optional)</label>
                <input type="url" class="form-control"  name="link" placeholder="Enter Link  (optional)">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Banner Type</label>
                <select class="form-control" name="type" id="type">
                  <option value="image">Image</option>
                  <option value="video">Video</option>
                </select>
              </div>
            </div>
            
          </div>
          <div class="row" id="type-content">
            <div class="col-md-6 mt-1">
              <div class="form-group">
                <label>Image (optional)</label>
                <input type="file" class="form-control"  name="image" >
              </div>
            </div>
            <div class="col-md-6 mt-1">
              <div class="form-group">
                <label>Background Image</label>
                <input type="file" class="form-control"  name="background_image" >
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
<script>
$(document).ready(function() {
$(document).on('change', '#type',function() {
var video_hmtl=`<div class="col-md-12 mt-1">
  <div class="form-group">
    <label>Vimeo Video Link</label>
    <input type="text" class="form-control"  name="video" placeholder="Vimeo Video Link">
  </div>
</div>`;
var image_html=`<div class="col-md-6 mt-1">
  <div class="form-group">
    <label>Image</label>
    <input type="file" class="form-control"  name="image" >
  </div>
</div>
<div class="col-md-6 mt-1">
  <div class="form-group">
    <label>Background Image</label>
    <input type="file" class="form-control"  name="background_image" >
  </div>
</div>`;
if($(this).val()=="video"){
$('#type-content').html(video_hmtl);
}else{
$('#type-content').html(image_html);
}
});
});
</script>
@endsection