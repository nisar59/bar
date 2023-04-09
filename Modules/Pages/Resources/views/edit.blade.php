@extends('layouts.template')
@section('title')
Pages
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Pages</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">CMS</li>
        <li class="breadcrumb-item active">Pages</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('admin/pages/update/'.$pages->id)}}" method="post">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Pages</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Slider/Banner</label>
                <select name="slider_banner_type" id="slider_banner_type" class="form-control select2">
                  <option value="">Select</option>
                  <option value="slider" @if($pages->slider_banner_type=="slider") selected @endif>Slider</option>
                  <option value="banner" @if($pages->slider_banner_type=="banner") selected @endif>Banner</option>
                </select>
              </div>
            </div>
            <div class="col-md-12" id="slider-banner">
              @if($pages->slider_banner_type=="slider")
              <div class="form-group">
                <label for="">Slider</label>
                <select name="slider_banner_id" class="form-control select2">
                  @foreach($sliders as $slider)
                  <option value="{{$slider->id}}" @if($slider->id==$pages->slider_banner_id) selected @endif>{{$slider->name}}</option>
                  @endforeach
                </select>
              </div>    
              @elseif($pages->slider_banner_type=="banner")
              <div class="form-group"><label for="">Banner</label>
              <select name="slider_banner_id" class="form-control select2">
                @foreach($banners as $banner)
                <option value="{{$banner->id}}" @if($banner->id==$pages->slider_banner_id) selected @endif>{{$banner->name}}</option>
                @endforeach
              </select></div>
              @else

              @endif
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" id="title" value="{{$pages->title}}" name="title" placeholder="Enter Title">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Slug</label>
                <input type="text" class="form-control" id="slug" value="{{$pages->slug}}" name="slug" placeholder="Enter Slug">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control"  id="" cols="68" placeholder="Enter Description " rows="5">{{$pages->description}}</textarea>
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
$(document).ready(function () {
$(document).on('keyup', '#title',function() {
var Text = $(this).val();
Text = Text.toLowerCase();
Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
$("#slug").val(Text);
});
$(document).on("change",'#slider_banner_type', function() {
var type=$(this).val();
var slider_html=`<div class="form-group">
                <label for="">Slider</label>
                <select name="slider_banner_id" class="form-control select2">
                  @foreach($sliders as $slider)
                  <option value="{{$slider->id}}" @if($slider->id==$pages->slider_banner_id) selected @endif>{{$slider->name}}</option>
                  @endforeach
                </select>
              </div>`;

var banner_html=`<div class="form-group"><label for="">Banner</label>
<select name="slider_banner_id" class="form-control select2">
  @foreach($banners as $banner)
  <option value="{{$banner->id}}" @if($banner->id==$pages->slider_banner_id) selected @endif>{{$banner->name}}</option>
  @endforeach
</select></div>`;
if(type=="slider"){
$("#slider-banner").html(slider_html);
}
else if(type=="banner"){
$("#slider-banner").html(banner_html);
}
else{
  $("#slider-banner").html('');

}
$(".select2").select2();
});
});
</script>
@endsection