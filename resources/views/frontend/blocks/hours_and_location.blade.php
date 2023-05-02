@php
$data=json_decode($data);
@endphp

<section id="intro" class="content c-intro container revealable">
  <div class="row">
    <div class="col-md-6">
      @if(isset($data->opening_hours)) {!!$data->opening_hours!!} @endif
    </div>
    <div class="col-md-6">
      <img src="@if(isset($data->map)) {{asset("images/frontend/".$data->map)}} @endif " class="w-100 fr-fic fr-dib" alt="a close up of a map">
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-md-6">
      <iframe class="w-100 h-100" src="@if(isset($data->video_url)) {{$data->video_url}} @endif"></iframe>
    </div>
    <div class="col-md-6">
      @if(isset($data->kiosk_opening_hours)) {!!$data->kiosk_opening_hours!!} @endif
    </div>
  </div>
</section>