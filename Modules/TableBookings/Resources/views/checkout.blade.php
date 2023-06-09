@extends('include.master')
@section('title')
Home | Dante NYC
@endsection
@section('content')

@php
$total=0;
@endphp

<div class="site-content">
	<div class="site-header-spacer-desktop" aria-hidden="true"></div><div class="site-header-spacer-mobile" aria-hidden="true" style="height:62.125px;"></div>
	<main class="site-content__main">
		<section class="content container">
			<div class="row justify-content-center" style="margin-top: 10%;">
				<div class="col-8">
					<div class="card">
						<div class="card-header bg-white">
							<h4 class="card-title text-dark fw-bold">Checkout</h4>
						</div>
						<div class="card-body">
                            <div class="row m-0">
                                <div class="col-12 border p-0 pt-3">
                                <div class="row text-dark m-0 p-0">
                                    <div class="col-6">
                                        <h6 class="fw-bold fs-5">Order Summery</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="fw-bold fs-5"></h6>
                                    </div>
                                    <hr class="mb-3 p-0">

                                    <div class="col-6">
                                        <h6 class="mb-2">Sitting</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="mb-2">
                                            @if($data->sitting()->exists())
                                            {{Carbon\Carbon::parse($data->sitting->time_from)->format('h:i A')}}
                                            @endif
                                        </h6>
                                    </div>

                                    <div class="col-6">
                                        <h6 class="mb-2">Date</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="mb-2">{{Carbon\Carbon::parse($data->booking_date)->format('D d-M-Y')}}</h6>
                                    </div>

                                    <div class="col-6">
                                        <h6 class="mb-2">Table</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="mb-2">
                                            @if($data->table()->exists())
                                                @if($data->table->table()->exists())
                                                Guests {{$data->table->table->guests}} 
                                                ({{$data->table->table->name}})

                                             @endif
                                             @endif
                                        </h6>
                                    </div>

                                    <div class="col-6">
                                        <h6 class="mb-2 fs-5 fw-bold">Price</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="mb-2 fs-5 fw-bold">
                                            @if($data->table()->exists()) £ {{number_format($data->table->price)}} @endif

                                            @php
                                            $total=(int) $total + (int) $data->table->price;
                                            @endphp
                                        </h6>
                                    </div>

                                    @if($data->extras()->exists())

                                    <div class="col-12">
                                        <h6 class="fw-bold fs-5">Extras</h6>
                                    </div>

                                    @foreach($data->extras as $extra)
                                        <div class="col-6">
                                            <h6 class="mb-2">{{$extra->name}}</h6>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="mb-2">${{number_format($extra->price)}}</h6>
                                            @php
                                            $total=(int) $total + (int) $extra->price;
                                            @endphp


                                        </div>
                                    @endforeach
                                    @endif

                                    <hr class="p-0 mb-2">

                                    <div class="col-6">
                                        <h6 class="mb-2 fs-5 fw-bold">Total</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="mb-2 fs-5 fw-bold">£ {{number_format($total)}}</h6>
                                    </div>

                                    <div class="col-md-12 mt-4">
                                        <div id="paypal-button-container"></div>
                                    </div>
                                </div>
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
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>

    // Render the PayPal button

    paypal.Button.render({

        // Set your environment

        env: '{{Settings()->payment_environment}}', // sandbox | production

        // Specify the style of the button

        style: {
            layout: 'vertical',  // horizontal | vertical
            size:   'medium',    // medium | large | responsive
            shape:  'rect',      // pill | rect
            color:  'white' ,    // gold | blue | silver | black
            label:  'checkout'       
        },

        // Specify allowed and disallowed funding sources
        //
        // Options:
        // - paypal.FUNDING.CARD
        // - paypal.FUNDING.CREDIT
        // - paypal.FUNDING.ELV

        funding: {
            allowed: [],
            disallowed: [paypal.FUNDING.CARD, paypal.FUNDING.CREDIT  ]
        },

        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create

        client: {
            sandbox:    '{{Settings()->sandbox_client_id}}',
            production: '{{Settings()->production_client_id}}'
        },

        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '{{$total}}', currency: 'USD' }
                        }
                    ]
                }
            });
        },

        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                window.location="{{url('table-bookings/checkout/success/'.$data->id)}}";
            });
        }

    }, '#paypal-button-container');

</script>
@endsection