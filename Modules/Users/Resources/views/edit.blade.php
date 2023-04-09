@extends('layouts.template')
@section('title')
Users
@endsection
@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Users</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">users</li>
        <li class="breadcrumb-item active">Edit User</li>
      </ol>
    </div>
  </div>
</div>
<form action="{{url('admin/users/update/'.$data['user']->id)}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-header bg-white">
          <h4>Edit Users</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label>Name</label>
              <input type="text" class="form-control" value="{{$data['user']->name}}" name="name" placeholder="Name">
            </div>
            <div class="form-group col-md-6">
              <label>Email</label>
              <input type="email" class="form-control" value="{{$data['user']->email}}" name="email" placeholder="Email">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label>Password</label>
              <input type="password" class="form-control" name="password" placeholder="Password">
              <p class="text-muted">leave empty, if you don't want to update the password</p>
            </div>
            
            @if(count($data['user']->roles)>0 && $data['user']->roles[0]->name=='super-admin')
            <div class="form-group col-md-6">
              <label>Role</label>
              <select class="form-control" disabled>
                <option value="">Super admin</option>
              </select>
            </div>
            @else
            <div class="form-group col-md-6">
              <label>Role</label>
              <select class="form-control select2" name="role">
                @foreach($data['role'] as $role)
                <option value="{{$role->name}}" @if(count($data['user']->roles)>0 && $data['user']->roles[0]->name==$role->name) selected @endif>{{$role->name}} </option>
                @endforeach
              </select>
            </div>
            @endif
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
@endsection