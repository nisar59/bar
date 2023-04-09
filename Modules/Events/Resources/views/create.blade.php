@extends('layouts.template')
@section('title')
Enter Events
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Events</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Events</li>
        <li class="breadcrumb-item active">Events</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('admin/events/store')}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Enter Events</h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label>Select Event</label>
                <select name="s_event" id="" class="form-control">
                  <option value="" class="form-control">Please Select One</option>
                  <option value="weakend" class="form-control">Weakened</option>
                  <option value="weak_night" class="form-control">Weak Night</option>
                </select>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" class="form-control" name="title" placeholder="Enter Title">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
               <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control"  id="" cols="68" placeholder="Enter Description " rows="5"></textarea>
          </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control" name="image" placeholder="Enter Image">
          </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
               <div class="form-group">
            <label>More Information Link</label>
            <input type="url" class="form-control" name="info_link" placeholder="Enter More Information Link">
          </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
            <label>Buy Ticket Link</label>
            <input type="url" class="form-control" name="ticket_link" placeholder="Enter Buy Ticket Link">
          </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
               <div class="form-group">
            <label>Facebook Link</label>
            <input type="url" class="form-control" name="face_link" placeholder="Enter Facebook Link">
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