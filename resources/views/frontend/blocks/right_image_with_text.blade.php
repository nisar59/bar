@php
$data=json_decode($data);
@endphp
<section class="">
  <div class="c-split__col ">
    <div class="c-split__col-inner">
      <div class="c-split__content content">
        @if(isset($data->text)) {!!$data->text!!} @endif
      </div>
    </div>
  </div>
  <div class="c-split__col c-split__col--empty">
    <div class="c-split__col-inner">
      <div class="c-split__image" role="presentation" style="background-image: url('@if(isset($data->image)) {{asset("images/frontend/".$data->image)}} @endif');background-position:none" aria-hidden="true" tabindex="-1"></div>
    </div>
  </div>
</section>