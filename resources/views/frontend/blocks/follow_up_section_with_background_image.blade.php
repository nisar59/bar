@php
$data=json_decode($data);
@endphp
<section class="c-tout-overlay c-tout-overlay--dimmed revealable" style="background-image: url('@if(isset($data->background_image)) {{asset("images/frontend/".$data->background_image)}} @endif');background-position:none">
	<div class="container">
		<h2 class="h1">@if(isset($data->heading)) {{$data->heading}} @endif</h2>
		<p>@if(isset($data->sub_heading)) {{$data->sub_heading}} @endif</p>
		<a href="@if(isset($data->link)) {{$data->link}} @endif" class="btn btn-brand" target="_parent">@if(isset($data->button_text)) {{$data->button_text}} @endif</a>
	</div>
</section>