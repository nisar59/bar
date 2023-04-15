@php
$data=json_decode($data);
@endphp
<section id="intro" class="content c-intro container-sm revealable revealed">
	<h1>@if(isset($data->heading)) {{$data->heading}} @endif</h1>
	 
	 @if(isset($data->qoute_text)) {!!$data->qoute_text!!} @endif       

</section>