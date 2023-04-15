@php
$data=json_decode($data);
@endphp
@if(isset($data->heading) && $data->heading!=null)
<section class="c-one-col--text content container revealable revealed">
	<h2 aria-level="1">@if(isset($data->heading)) {{$data->heading}} @endif</h2>
</section>
@endif

<section class="c-two-col--text content container revealable revealed">
	
	<div class="row">
		@if(isset($data->product_showcase) && $data->product_showcase!=null && ProductShowcase($data->product_showcase)!=null && ProductShowcase($data->product_showcase)->images()->exists())
			@foreach(ProductShowcase($data->product_showcase)->images as $img)
		<div class="col-md-6">	
			<img src="{{asset('images/product-showcase/'.$img->image)}}" class="w-100">
		</div>
			@endforeach
		@endif
	</div>
</section>