@php
$data=json_decode($data);
@endphp

<section class="c-one-col--text content container revealable revealed">
<div class="row mt-5">
	<div class="col-md-12">
	@if(isset($data->intro)) {!!$data->intro!!} @endif	
	</div>
</div>


<div class="accordion accordion-flush" id="accordionFlushExample">
	@if(Faqs()->count()>0)
	@foreach(Faqs() as $key=> $faq)
  <div class="accordion-item mt-3">
    <h2 class="accordion-header" id="flush-heading{{$key}}">
      <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$key}}" aria-expanded="false" aria-controls="flush-collapse{{$key}}">
        {{$faq->title}}
      </button>
    </h2>
    <div id="flush-collapse{{$key}}" class="accordion-collapse text-dark collapse" aria-labelledby="flush-heading{{$key}}" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">{!!$faq->description!!}</div>
    </div>
  </div>
  	@endforeach
  @endif
</div>


</section>