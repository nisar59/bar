@extends('layouts.template')
@section('title')
Settings
@endsection

@section('css')
<style>
.tox-tinymce-aux {
    z-index: 999999!important;
}
.tox .tox-menu{
    background-color: white !important;
}
</style>
@endsection

@section('content')
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-md-8">
      <h6 class="page-title">Panel Settings</h6>
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item">{{Settings()->portal_name}}</li>
        <li class="breadcrumb-item">Panel Settings</li>
        <li class="breadcrumb-item active">Panel Settings</li>
      </ol>
    </div>
  </div>
</div>
@php
$sett=$data['settings'];
$logo=url('public/img/images.png');
$favicon=url('public/img/images.png');
if($sett->portal_logo!='' AND file_exists(public_path('img/settings/'.$sett->portal_logo))){
$logo=url('public/img/settings/'.$sett->portal_logo);
}
if($sett->portal_favicon!='' AND file_exists(public_path('img/settings/'.$sett->portal_favicon))){
$favicon=url('public/img/settings/'.$sett->portal_favicon);
}
@endphp
<form action="{{url('admin/settings/store')}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-primary">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
              <div class="list-group nav-tabs penal-settings" role="tablist">
                <a class="list-group-item text-center rounded-0 active" data-bs-toggle="tab" href="#main-settings" role="tab">
                  Main Settings
                </a>
                <a class="list-group-item text-center rounded-0" data-bs-toggle="tab" href="#templates" role="tab">
                  Templates
                </a>
                <a class="list-group-item text-center rounded-0" data-bs-toggle="tab" href="#paypal" role="tab">
                  PayPal
                </a>
                <a class="list-group-item text-center rounded-0" data-bs-toggle="tab" href="#application-logs" role="tab">
                  Application Logs
                </a>
              </div>
            </div>
            <!-- Tab panes -->
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
              <div class="tab-content">
                <div class="tab-pane active p-3" id="main-settings" role="tabpanel">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Panel Name</label>
                      <input type="text" class="form-control" name="panel_name" value="{{$sett->portal_name}}" placeholder="Panel Name">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Panel Email</label>
                      <input type="email" class="form-control" name="panel_email" value="{{$sett->portal_email}}" placeholder="Panel Email">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6 mt-2">
                      <label>Panel Logo (2388x1988)</label>
                      <input type="file" class="form-control" name="panel_logo" id="panel_logo">
                      <span><b>{{$sett->penal_logo}}</b></span>
                    </div>
                    <div class="form-group col-md-6 mt-2">
                      <label>Panel Favicon (16x16)</label>
                      <input type="file" class="form-control" name="panel_favicon" id="panel_favicon">
                      <span><b>{{$sett->portal_favicon}}</b></span>
                      <!--  -->
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6 mt-2">
                      <label>Website Logo(1297x597)</label>
                      <input type="file" class="form-control" name="website_logo" id="">
                      <span><b>{{$sett->website_logo}}</b></span>
                    </div>
                    <div class="form-group col-md-6 mt-2">
                      <label>Website Small Logo(600x162)</label>
                      <input type="file" class="form-control" name="website_s_logo" id="">
                      <span><b>{{$sett->website_small_logo}}</b></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6 mt-2">
                      <label>Website Favicon(16x16)</label>
                      <input type="file" class="form-control" name="website_favicon" id="">
                      <span><b>{{$sett->website_favicon}}</b></span>
                    </div>
                    
                  </div>
                </div>
                <div class="tab-pane p-3" id="templates" role="tabpanel">
                  <div class="row">

                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Order Email Subject</label>
                        <input name="order_email_subject" value="{{$sett->order_email_subject}}" placeholder="Order Email Subject" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-12 mt-3">
                      <div class="form-group">
                        <label for="">Order Email <span class="fs-6 fw-normal">(use below tags)</span></label>
                        <pre>{name}  {phone}  {email}  {booking-date}  {sitting}  {table}  {sitting-price} {extras}  {total}
                        </pre>
                        <textarea name="order_email_template" class="form-control editor">{{$sett->order_email_template}}</textarea>
                      </div>
                    </div>

                    <div class="col-md-12 mt-2">
                      <div class="form-group">
                        <label for="">Reservation Message</label>
                        <textarea name="reservation_message" class="form-control editor">{{$sett->reservation_message}}</textarea>
                      </div>
                    </div>

                    <div class="col-md-12 mt-2">
                      <div class="form-group">
                        <label for="">Checkout Success Message</label>
                        <textarea name="checkout_success_message" class="form-control editor">{{$sett->checkout_success_message}}</textarea>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="tab-pane p-3" id="paypal" role="tabpanel">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Payment Environment</label>
                        <select name="payment_environment" id="" class="form-control">
                          <option value="sandbox" @if($sett->payment_environment="sandbox") selected @endif>Sandbox</option>
                          <option value="production" @if($sett->payment_environment="production") selected @endif>production</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Sandbox Secret Key</label>
                        <input type="text" class="form-control" value="{{$sett->sandbox_secret_key}}" name="sandbox_secret_key" placeholder="Enter Sandbox Secret ID">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Sandbox Client ID</label>
                        <input type="text" class="form-control" value="{{$sett->sandbox_client_id}}" name="sandbox_client_id" placeholder="Enter Sandbox Client ID">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 mt-2">
                      <div class="form-group">
                        <label for="">Production Secret Key</label>
                        <input type="text" class="form-control" value="{{$sett->production_secret_key}}" name="production_secret_key" placeholder="Enter Production Secret ID">
                      </div>
                    </div>
                    <div class="col-md-4 mt-2">
                      <div class="form-group">
                        <label for="">Production Client ID</label>
                        <input type="text" class="form-control" value="{{$sett->production_client_id}}" name="production_client_id" placeholder="Enter Production Client ID">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane p-3" id="application-logs" role="tabpanel">
                  <div class="row">
                    <div class="col-md-4 form-group">
                      <label for="">Logging</label>
                      <select name="logging" class="form-control">
                        <option value="1" {{$sett->logging=='1' ? 'selected' : ''}}>Yes</option>
                        <option value="0" {{$sett->logging=='0' ? 'selected' : ''}}>No</option>
                      </select>
                    </div>
                    <div class="col-md-4 form-group">
                      <label for="">Logs will be deleted older Than</label>
                      <input type="number" min="1" value="{{$sett->logs_duration!=null ? $sett->logs_duration : 7}}" class="form-control" name="logs_duration" placeholder="Logs will be deleted older Than">
                    </div>
                    <div class="col-md-4 form-group">
                      <label for="">Duration type</label>
                      <select name="logs_duration_type" class="form-control">
                        <option value="days" {{$sett->logs_duration_type=='days' ? 'selected' : ''}}>Days</option>
                        <option value="weeks" {{$sett->logs_duration_type=='weeks' ? 'selected' : ''}}>Weeks</option>
                        <option value="months" {{$sett->logs_duration_type=='months' ? 'selected' : ''}}>Months</option>
                        <option value="years" {{$sett->logs_duration_type=='years' ? 'selected' : ''}}>Years</option>
                      </select>
                    </div>
                  </div>
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
@endsection