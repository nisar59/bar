@extends('include.master')
@section('title')
Home | Dante NYC
@endsection
@section('css')
<style>
	hr{
		width: 100%;
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
						<div class="card-body text-dark">
							{!! Settings()->checkout_success_message !!}
						</div>
					</div>
				</div>
				<div class="col-8" id="invoice">
					<div class="card">
						<div class="card-body text-dark p-0">
							<div class="row m-2">
								<div class="col-6 text-start">
									<h2 class="fw-bold m-0">{{Settings()->portal_name}}</h2>
								</div>
								<div class="col-6 text-end">
									<h2 class="fw-bold m-0">Invoice</h2>
								</div>
							</div>
							<hr class="m-0">
							<div class="row m-0">
								<div class="col-7 text-start">
									<p class="m-1 fw-bold">Name: <span class="fw-normal">{{@UserDetail($data->user_id)->name}}</span></p>
									<p class="m-1 fw-bold">Email: <span class="fw-normal">{{@UserDetail($data->user_id)->email}}</span></p>
									<p class="m-1 fw-bold">Phone: <span class="fw-normal">{{@UserDetail($data->user_id)->phone}}</span></p>
								</div>
								<div class="col-5 text-start">
									<p class="m-1 fw-bold">Date: <span class="fw-normal">{{@Carbon\Carbon::parse(@$data->booking_date)->format('D d-M-Y')}}</span></p>
									<p class="m-1 fw-bold">Sitting: <span class="fw-normal">{{@Carbon\Carbon::parse(@$data->sitting->time_from)->format('h:i A')}}</span></p>
									<p class="m-1 fw-bold">Table: <span class="fw-normal">Guests {{@$data->table->table->guests}} ({{@$data->table->table->name}})</span></p>
									<p class="m-1 fw-bold">Sitting Price: <span class="fw-normal">£ {{@number_format($data->table->price)}}</span></p>
								</div>
							</div>

							<div class="row m-0 mt-2">
								<div class="col-12 text-start">
									<h3 class="text-dark fw-bold">Extras</h3>
								</div>

								<div class="col-12">
									<table class="table table-bordered table-sm">
										<thead>
											<th class="text-center">Sr No#</th>
											<th class="text-center w-75">Name</th>
											<th class="text-center">Price</th>
										</thead>


										<tbody>
											@forelse($data->extras as $key=> $extra)
											<tr>
												<td>{{$key+1}}</td>
												<td>{{$extra->name}}</td>
												<td>£ {{number_format($extra->price)}}</td>
											</tr>
											@empty
											<tr><td colspan="3">No Extra Found</td></tr>
											@endforelse
										</tbody>
									</table>
								</div>
								<div class="col-12 text-end">
									<h3 class="text-dark fw-bold">Total: <span class="fw-normal">£ {{@number_format($data->amount)}}</span></h3>
									<h3 class="text-dark fw-bold">Status: <span class="fw-normal text-success">Paid</span></h3>
								</div>

								<div class="col-12 p-2">
									<a class="text-info print-button" href="javascript:void(0)">Print</a>
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
	$(".print-button").on('click', function () {
		var head_content=$('head').html();

		var mywindow = window.open('', 'PRINT');

	    mywindow.document.write('<html><head>'+head_content);
	    mywindow.document.write('</head><body class="bg-light">');

	    mywindow.document.write(document.getElementById('invoice').innerHTML);
	    mywindow.document.write('</body></html>');

	    mywindow.document.close(); // necessary for IE >= 10
	    mywindow.focus(); // necessary for IE >= 10*/

	    mywindow.print();
	    mywindow.close();

	    return true;

	});
});
</script>
@endsection