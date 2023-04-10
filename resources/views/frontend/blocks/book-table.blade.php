@php
$data=json_decode($data);
@endphp
<section class="c-split c-split--vcenter revealable">
	<div class="c-split__col ">
		<div class="c-split__col-inner">
			<div class="c-split__content content">
				<h2 class="h2 c-split__heading">@if(isset($data->heading)) {{$data->heading}} @endif</h2>
				<p>@if(isset($data->sub_heading)) {{$data->sub_heading}} @endif</p>
				<button type="button" class="btn btn-brand" data-popup="inline" data-popup-src="#popup-reservations-form" tabindex="0" data-bb-track="button" data-bb-track-on="click" data-bb-track-category="Reservations Trigger Button" data-bb-track-action="Click" data-bb-track-label="Multi Button">@if(isset($data->button_text)) {{$data->button_text}} @endif</button>
			</div>
		</div>
	</div>
	<div class="c-split__col c-split__col--empty">
		<div class="c-split__col-inner">
			<div class="c-split__image" role="img" aria-label="Dante Negroni over Menu" style="background-image: url('@if(isset($data->image)) {{asset("images/frontend/".$data->image)}} @endif');background-position:none"></div>
		</div>
	</div>
</section>