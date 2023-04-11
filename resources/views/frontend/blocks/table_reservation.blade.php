@php
$data=json_decode($data);
@endphp
<section class="c-split c-split--vcenter revealable">
	<div class="c-split__col ">
		<div class="c-split__col-inner">
			<div class="c-split__content content">
				<h2 class="h2 c-split__heading">@if(isset($data->heading)) {{$data->heading}} @endif</h2>
				<p>@if(isset($data->sub_heading)) {{$data->sub_heading}} @endif</p>
				<button type="button" class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#exampleModal">@if(isset($data->button_text)) {{$data->button_text}} @endif</button>
			</div>
		</div>
	</div>
	<div class="c-split__col c-split__col--empty">
		<div class="c-split__col-inner">
			<div class="c-split__image" role="img" aria-label="Dante Negroni over Menu" style="background-image: url('@if(isset($data->image)) {{asset("images/frontend/".$data->image)}} @endif');background-position:none"></div>
		</div>
	</div>

</section>	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">New message</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form>
						<div class="mb-3">
							<label for="recipient-name" class="col-form-label">Recipient:</label>
							<input type="text" class="form-control" id="recipient-name">
						</div>
						<div class="mb-3">
							<label for="message-text" class="col-form-label">Message:</label>
							<textarea class="form-control" id="message-text"></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Send message</button>
				</div>
			</div>
		</div>
	</div>