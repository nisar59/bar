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
<div class="row">
  <div class="col-12">
    <div class="card card-primary">
      <div class="card-header bg-white">
        <div class="row">
          <h4 class="col-md-6">FAQs</h4>
          <div class="col-md-6 text-end">
            <a href="{{url('admin/faqs/create')}}" class="btn btn-success">+</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-hover table-bordered" id="faqs" style="width:100%;">
            <thead class="text-center bg-primary text-white">
              <tr>
                <th>Title</th>
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
@endsection
@section('js')
<script type="text/javascript">
    //Roles table
    $(document).ready( function(){
  var roles_table = $('#faqs').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{url('admin/faqs')}}",
              buttons:[],
              columns: [
                {data: 'title', name: 'title',class:'text-center'},
                {data: 'status', name: 'status', orderable: false, searchable: false ,class:'text-center'},
                {data: 'action', name: 'action', orderable: false, searchable: false ,class:'text-center'},
            ]
          });
      });
</script>
@endsection
