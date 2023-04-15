@extends('include.master')
@section('title')
Home | Dante NYC
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
							<h4 class="card-title text-dark fw-bold">Checkout</h4>
						</div>
						<div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                                                        
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

        env: 'sandbox', // sandbox | production

        // Specify the style of the button

        style: {
            layout: 'vertical',  // horizontal | vertical
            size:   'medium',    // medium | large | responsive
            shape:  'rect',      // pill | rect
            color:  'blue'       // gold | blue | silver | black
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
            sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
            production: '<insert production client id>'
        },

        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '5', currency: 'USD' }
                        }
                    ]
                }
            });
        },

        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                window.location="{{url('table-bookings/checkout/success/1')}}";
            });
        }

    }, '#paypal-button-container');

</script>
@endsection