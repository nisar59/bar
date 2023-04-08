@extends('layouts.template')
@section('title')
Product Showcase
@endsection
@section('content')

<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Product Showcase</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">CMS</li>
        <li class="breadcrumb-item active">Product Showcase</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('productshowcase/store')}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Product Showcase</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Title">
          </div>
          </div>
        </div>
        <div class="row">
           <div class="col-md-12 mt-3 mb-4">
             <label for="">Multipel Images</label>
            <div class="input-group control-group increment" >
             
          <input type="file" name="image[]" class="form-control">
          <div class="input-group-btn"> 
            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
          </div>
        </div>
        <div class="clone hide">
          <div class="control-group input-group mb-4" style="margin-top:10px">
            <input type="file" name="image[]" class="form-control">
            <div class="input-group-btn"> 
              <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
            </div>
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
<script type="text/javascript">
    $(document).ready(function() {
      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });
    });
</script>
@endsection

