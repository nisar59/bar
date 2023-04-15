@section('modal')
<div class="modal fade" id="contact-us" tabindex="-1" aria-labelledby="contact-us-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header justify-content-center">
				<h5 class="modal-title text-dark" id="contact-us-label">Contact us</h5>
			</div>
			<form action="{{url('contact-us/send')}}" method="post">
				<div class="modal-body">
					<div class="mb-3">
						<label for="email" class="col-form-label text-dark">Email</label>
						<input type="email" min="1" class="form-control border border-dark" name="email" id="email" placeholder="Email" required>
					</div>
					<div class="mb-3">
						<label for="subject" class="col-form-label text-dark">Subject</label>
						<input type="text" class="form-control border border-dark" name="subject" id="subject" placeholder="Subject" required>
					</div>
					<div class="mb-3">
						<label for="message" class="col-form-label text-dark">Message</label>
						<textarea name="message" id="message" cols="30" rows="10" placeholder="Message"></textarea>
					</div>					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success mt-2 w-auto">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection