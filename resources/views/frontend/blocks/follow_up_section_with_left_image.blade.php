@php
$data=json_decode($data);
@endphp
<section class="c-split c-split--vcenter c-split--alternate revealable">
	<div class="c-split__col ">
		<div class="c-split__col-inner">
			<div class="c-split__content content">
				<h2 class="h2 c-split__heading">@if(isset($data->heading)) {{$data->heading}} @endif</h2>
				<p>@if(isset($data->sub_heading)) {{$data->sub_heading}} @endif</p>
				<a href="@if(isset($data->link)) {{$data->link}} @endif" class="btn btn-brand" target="_parent">@if(isset($data->button_text)) {{$data->button_text}} @endif</a>
			</div>
		</div>
	</div>
	<div class="c-split__col c-split__col--empty">
		<div class="c-split__col-inner">
			<div class="c-split__image" role="img" aria-label="a cake sitting on top of a table" style="background-image: url('@if(isset($data->image)) {{asset("images/frontend/".$data->image)}} @endif');background-position:none"></div>
		</div>
	</div>
</section>