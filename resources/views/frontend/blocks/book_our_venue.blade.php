@php
$data=json_decode($data);
$img_one=isset($data->first_image) ? $data->first_image : '';
$img_two=isset($data->second_image) ? $data->second_image : '';
$img_three=isset($data->third_image) ? $data->third_image : '';
@endphp
<section class="c-two-col--text content container revealable revealed h-100">
<div class="row align-items-center vh-100 justify-content-center">

	<div class="col-md-4 mx-auto">
		<img src="{{asset('images/frontend/'.$img_one)}}" class="w-100" alt="">
		<p class="mt-2">@if(isset($data->first_image_description)) {{$data->first_image_description}} @endif</p>
		<button class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#contact-us">@if($data->first_button_text) {{$data->first_button_text}} @endif</button>
	</div>


	<div class="col-md-4 mx-auto">
		<img src="{{asset('images/frontend/'.$img_two)}}" class="w-100" alt="">
		<p class="mt-2">@if(isset($data->second_image_description)) {{$data->second_image_description}} @endif</p>
		<button class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#contact-us">@if($data->second_button_text) {{$data->second_button_text}} @endif</button>
	</div>


	<div class="col-md-4 mx-auto">
		<img src="{{asset('images/frontend/'.$img_three)}}" class="w-100" alt="">
		<p class="mt-2">@if(isset($data->third_image_description)) {{$data->third_image_description}} @endif</p>
		<button class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#contact-us">@if($data->third_button_text) {{$data->third_button_text}} @endif</button>
	</div>


</div>
</section>

@include('frontend.blocks.contact-us-modal')