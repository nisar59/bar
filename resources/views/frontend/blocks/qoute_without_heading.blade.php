@php
$data=json_decode($data);
@endphp
<section class="c-one-col--text content container revealable revealed">
@if(isset($data->qoute_text)) {!! $data->qoute_text !!} @endif

</section>