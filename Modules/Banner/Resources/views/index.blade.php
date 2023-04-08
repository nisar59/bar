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
<div class="row">
  <div class="col-12">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <div class="row">
          <h4 class="col-md-6">Banner</h4>
          <div class="col-md-6 text-end">
            <a href="{{url('banner/create')}}" class="btn btn-success">+</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-hover table-bordered" id="banner" style="width:100%;">
            <thead class="text-center bg-primary text-white">
              <tr>
                <th>Heading</th>
                <th>Sub Heading</th>
                <th>Link</th>
                <th>Banner Type</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div>
 <div class="modal fade" id="banner-show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Banner</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="body">
        <p class="text-center">empty</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 
</div>
@endsection
@section('js')
<script type="text/javascript">
    //Roles table
    $(document).ready( function(){
  var roles_table = $('#banner').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{url('banner')}}",
              buttons:[],
              columns: [
                {data: 'heading', name: 'heading',class:'text-center'},
                {data: 'sub_heading', name: 'sub_heading',class:'text-center'},
                {data: 'link', name: 'link',class:'text-center'},
        
                 {data: 'type', name: 'type',class:'text-center'},

                {data: 'status', name: 'status', orderable: false, searchable: false ,class:'text-center'},

                {data: 'action', name: 'action', orderable: false, searchable: false ,class:'text-center'},
            ]
          });

$(document).on('click', '.banner-show', function() {
  var type=$(this).data('type');
  var img=$(this).data('img');
  var bgimg=$(this).data('bgimg');
  var video=$(this).data('video');
  var img_html=`
          <p><b>Image</b></p>
          <img class="w-100" src="`+img+`" alt="">
          <p><b>Background Image</b></p>
          <img class="w-100" src="`+bgimg+`" alt="">`;

  var video_html=`
  <iframe src="`+video+`" class="w-100"></iframe>
          `;



if(type=="image"){
$("#banner-show #body").html(img_html);
}

if(type=="video"){
$("#banner-show #body").html(video_html);
}

  $("#banner-show").modal('show');
});



      });
</script>
@endsection

