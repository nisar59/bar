@extends('include.master')
@section('title')
Home | Dante NYC
@endsection
@section('content')
<div class="site-content">
	<div class="site-header-spacer-desktop" aria-hidden="true"></div><div class="site-header-spacer-mobile" aria-hidden="true" style="height:62.125px;"></div>
	<main class="site-content__main">
		<section class="content container">
			<div class="popup--modal"style="margin-top: 10%;">
				<form class="form-alt container" action="{{ route('register') }}" method="POST">
					@csrf
					<div class="form-header">
						<h2 class="h1 form-heading" aria-level="1">Register</h2>
					</div>
					<div class="form-ui">
						<label role="presentation" class="input--populated">
							<span class="input-label show" aria-hidden="true" id="ae_label_select_desc1">Name
								<span class="input-label-required">- Required</span>
							</span>
							<div class="form-control-group">
								<input type="text" class="form-control" name="name" placeholder="Enter Name">
								@error('name')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
						</label>

						<label role="presentation" class="input--populated">
							<span class="input-label show" aria-hidden="true" id="ae_label_select_desc1">Email
								<span class="input-label-required">- Required</span>
							</span>
							<div class="form-control-group">
								<input type="email" class="form-control" name="email" placeholder="Enter Email">
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

							</div>
						</label>

						<label role="presentation" class="input--populated">
							<span class="input-label show" aria-hidden="true" id="ae_label_select_desc1">Password
								<span class="input-label-required">- Required</span>
							</span>
							<div class="form-control-group">
								<input type="password" class="form-control" name="password" placeholder="Enter Password">
                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror								
							</div>
						</label>

						<label role="presentation" class="input--populated">
							<span class="input-label show" aria-hidden="true" id="ae_label_select_desc1">Confirm Password
								<span class="input-label-required">- Required</span>
							</span>
							<div class="form-control-group">
								<input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
							</div>
						</label>

					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-brand-alt">Register</button>
					</div>
				</form>
			</div>
		</section>
	</main>
</div>
@endsection