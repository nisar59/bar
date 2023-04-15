@php
$data=json_decode($data);
@endphp
@if(isset($data->description) && $data->description!=null)
<section class="c-one-col--text content container revealable revealed">
	@if(isset($data->description)) {!!$data->description!!} @endif	
</section>
@endif

<section class="c-two-col--text content container revealable revealed">
	
	<div class="row">
		@if(BottomLessBrunch()->count()>0)

			@foreach(BottomLessBrunch() as $blb)
		<div class="col-md-4">	
			<img src="{{asset('images/brunch/'.$blb->image)}}" class="w-100">
			<p class="mt-2">{{$blb->description}}</p>

			<button type="button" class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#reservation">Book Now</button>
		</div>
			@endforeach
		@endif
	</div>
</section>

@section('modal')
<div class="modal fade" id="reservation" tabindex="-1" aria-labelledby="reservation	Label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header justify-content-center">
				<h5 class="modal-title text-dark" id="reservation	Label">RESERVATIONS</h5>
			</div>
			<form action="{{url('table-bookings/create')}}">
				<div class="modal-body">
					<div class="mb-3">
						<label for="guest" class="col-form-label text-dark">Guests:</label>
						<input type="number" min="1" class="form-control border border-dark" name="guests" id="guest" placeholder="Number of Guests" required>
					</div>
					<div class="mb-3">
						<label for="date" class="col-form-label text-dark">Date:</label>
						<input type="date" class="form-control border border-dark" name="date" id="date" required>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success mt-2 w-auto">Next</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
