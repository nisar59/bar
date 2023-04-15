@php
$data=json_decode($data);
@endphp

<section class="c-one-col--text content container revealable revealed">
  @if(isset($data->contact_us_detail)) {!!$data->contact_us_detail!!} @endif
</section>