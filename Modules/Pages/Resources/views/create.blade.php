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
<form action="{{url('pages/store')}}" method="post">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Pages</h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
          </div>
          <div class="form-group">
            <label>Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Slug">
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control"  id="" cols="68" placeholder="Enter Description " rows="5"></textarea>
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
  
  $("#title").keyup(function() {
  var Text = $(this).val();
  Text = Text.toLowerCase();
  Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
  $("#slug").val(Text);        
});  

});
</script>
@endsection