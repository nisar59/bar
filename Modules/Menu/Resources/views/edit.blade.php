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
<form action="{{url('admin/menu/update/'.$menu->id)}}" method="post">
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
                <label>Type</label>
                <select name="type" id="" class="form-control">
                  <option value="" class="form-control">Please Select One</option>
                  <option value="header"{{$menu->type== "header" ? 'selected': ''}}>Header</option>
                  <option value="footer"{{$menu->type== "footer" ? 'selected': ''}}>Footer</option>
                  <option value="footer">Footer</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" value="{{$menu->name}}" id="name" name="name" placeholder="Enter Name">
          </div>
            </div>
            <div class="col-md-6 mt-2">
              <div class="form-group">
                <label>Pages</label>
                <select name="page_slug" class="form-control">
                  <option value=""></option>
                @foreach($pages as $page)
                <option value="{{$page->slug}}"@if($page->slug==$menu->page_slug) selected @endif>{{$page->slug}}</option>
                @endforeach
              </select>
              </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
            <label>URL</label>
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
@section('js')
<script>
  $("#name").keyup(function() {
  var Text = $(this).val();
  Text = Text.toLowerCase();
  Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
  $("#slug").val(Text);        
});
</script>
@endsection