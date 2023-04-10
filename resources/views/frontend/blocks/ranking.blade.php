@php
$data=json_decode($data);
@endphp
<section class="c-two-col--text content container revealable">
	<div class="row">
		<div class="col-md-6">
			<h2>@if(isset($data->heading_one)) {{$data->heading_one}} @endif</h2>
			<p>@if(isset($data->subheading_one)) {{$data->subheading_one}} @endif</p>
			<p>
				<br>
			</p>
		</div>
		<div class="col-md-6">
			<h2>@if(isset($data->heading_two)) {{$data->heading_two}} @endif</h2>
			<p>@if(isset($data->subheading_two)) {{$data->subheading_two}} @endif</p>
		</div>
	</div>
</section>