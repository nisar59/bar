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
			</div>
		</section>
	</main>
</div>
@endsection
@section('js')

@endsection