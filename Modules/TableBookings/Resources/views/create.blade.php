@extends('include.master')
@section('title')
Home | Dante NYC
@endsection
@section('css')
<style>
.extras-container {
overflow: hidden;  /* Hide the element content, while height = 0 */
height: 0;
opacity: 0;
transition: height 0ms 400ms, opacity 400ms 0ms;
}
.extras-container.visible-container {
height: auto;
opacity: 1;
transition: height 1s 0s, opacity 1s 0ms;
}
</style>
@endsection
@section('content')
<div class="site-content">
	<div class="site-header-spacer-desktop" aria-hidden="true"></div><div class="site-header-spacer-mobile" aria-hidden="true" style="height:62.125px;"></div>
	<main class="site-content__main">
		<section class="content container">
			<div class="row justify-content-center" style="margin-top: 10%;">
				<div class="col-8">
					<div class="card">
						<div class="card-header bg-white">
							<h4 class="card-title text-dark">Reservation</h4>
						</div>
						<div class="card-body pb-0">
							<form action="" class="m-0">
								<div class="row">
									<div class="col-md-12 text-start">
										<p class="text-dark fw-bold">Need to Know:</p>
										<p class="text-dark small">Your reservation is for a two hour dining experience and will be held for 15 minutes past your reserved time. We do NOT take reservations for drinks only. Please contact us if you are running late on +1 212 982 5275. Children of any age are welcome at all times. Table preferences are considered yet not guarantee. Our menus are available at dante-nyc.com</p>
									</div>
									<div class="col-md-6 text-start">
										<div class="mb-3">
											<label for="guest" class="col-form-label text-dark">No of Guests:</label>
											<input type="number" min="1" value="{{request()->guests}}" class="form-control border border-dark fields" name="guests" id="guests" placeholder="Number of Guests" required>
										</div>
									</div>
									<div class="col-md-6 text-start">
										<div class="mb-3">
											<label for="date" class="col-form-label text-dark">Date:</label>
											<input type="date" value="{{request()->date}}" class="form-control border border-dark fields datepicker" autocomplete="false" name="date" id="date" required>
										</div>
									</div>
								</div>
								<div class="row">
									@foreach($data as $table)
									@php
									$tm=Carbon\Carbon::parse($table->time_from);
									@endphp
									<div class="col-md-4 mb-3">
										<button type="button" class="btn btn-block table-button m-0 fw-bold btn-outline-primary border-primary rounded p-2">{{$tm->format('h:i A')}}</button>
										<input type="checkbox" hidden name="table" value="{{$table->id}}" class="table">
									</div>
									@endforeach
								</div>
								<div class="row extras-container">
									<div class="col-md-12 text-start">
										<h6 class="text-dark fw-bold">Extras</h6>
									</div>
									@foreach($extras as $extra)
									<div class="col-md-4 mb-3">
										<button type="button" class="btn btn-block extras-button m-0 fw-bold btn-outline-primary border-primary rounded p-2">{{$extra->name}} <br><span class="text-lowercase small">price: {{number_format($extra->price)}}</span></button>
										<input type="checkbox" hidden name="extras[]" value="{{$extra->id}}" class="extras">
									</div>
									@endforeach
								</div>
							</form>
						</div>
						<div class="card-footer reservation-submit" hidden>
							<div class="row justify-content-center">
								<div class="col-md-8">
										<button type="submit" class="btn btn-block btn-primary bg-primary fw-bold text-white m-0 p-2 rounded">Reserve Now</button>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
</div>
@endsection
@section('js')
<script type="text/javascript">
$(document).ready(function() {
$(document).on('change','.fields', function(){
		var date=$('#date').val();
		var guests=$('#guests').val();
		window.location="{{url('table-bookings/create/')}}?guests="+guests+"&date="+date;
});
$(document).on('click','.table-button', function() {
			$(".reservation-submit").removeAttr('hidden');
			$(".extras-container").addClass('visible-container');
			$('.table-button').removeClass('bg-primary text-white');
			$(this).addClass('bg-primary text-white');
			$('.table').removeAttr('checked');
			$(this).siblings('.table').attr('checked', true);
});
$(document).on('click','.extras-button', function() {
	var extra_is=$(this).siblings('.extras').is(":checked");
	if(!extra_is){
			$(this).addClass('bg-primary text-white');
			$(this).siblings('.extras').attr('checked', true);
	}else{
			$(this).removeClass('bg-primary text-white');
			$(this).siblings('.extras').attr('checked', false);
	}
});

});
</script>
@endsection