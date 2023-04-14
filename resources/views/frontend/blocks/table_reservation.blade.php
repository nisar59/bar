@php
$data=json_decode($data);
@endphp
<section class="c-split c-split--vcenter revealable">
	<div class="c-split__col ">
		<div class="c-split__col-inner">
			<div class="c-split__content content">
				<h2 class="h2 c-split__heading">@if(isset($data->heading)) {{$data->heading}} @endif</h2>
				<p>@if(isset($data->sub_heading)) {{$data->sub_heading}} @endif</p>
				<button type="button" class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#reservation">@if(isset($data->button_text)) {{$data->button_text}} @endif</button>
			</div>
		</div>
	</div>
	<div class="c-split__col c-split__col--empty">
		<div class="c-split__col-inner">
			<div class="c-split__image" role="img" aria-label="Dante Negroni over Menu" style="background-image: url('@if(isset($data->image)) {{asset("images/frontend/".$data->image)}} @endif');background-position:none"></div>
		</div>
	</div>
</section>
@section('modal')
<div class="modal fade" id="reservation" tabindex="-1" aria-labelledby="reservationLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header justify-content-center">
				<h5 class="modal-title text-dark" id="reservationLabel">RESERVATIONS</h5>
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