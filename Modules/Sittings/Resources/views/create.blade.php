@extends('layouts.template')
@section('title')
Sittings
@endsection
@section('content')

<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Sittings</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Sittings</li>
        <li class="breadcrumb-item active">Create</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('admin/sittings/store')}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Add Sitting</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Name">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Time From</label>
                    <input type="time" class="form-control" name="time_from">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Time To</label>
                    <input type="time" class="form-control" name="time_to">
                  </div>
                </div>
            </div>    
            <hr>
            <div class="row">
              <div class="col-md-12">
                <h4>Sitting Tables</h4>
              </div>
              <div class="col-12">
              @if($data->tables()->exists())
                @foreach($data->tables as $table)
                  <div class="row mb-2">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Table Name</label>
                        <input type="text" value="{{$table->name}}" class="form-control" disabled placeholder="Table Name">
                        <input type="text" hidden value="{{$table->id}}" name="tables[]">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">No of Guests</label>
                        <input type="text" value="{{$table->guests}}" class="form-control" placeholder="No of Guests" disabled>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" value="{{$table->table}}" name="price[]" class="form-control" placeholder="Price">
                      </div>
                    </div>

                  </div>
                @endforeach
              @endif
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