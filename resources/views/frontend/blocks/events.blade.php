@php
$data=json_decode($data);
@endphp
<section class="c-one-col--text content container revealable revealed">
	@if(isset($data->about_your_events)) {!!$data->about_your_events!!} @endif
</section>
<section class="c-two-col--text content container revealable revealed">
	<div class="row">
		@if(WeeklyEvents()->count()>0)
		@foreach(WeeklyEvents() as $wevent)
		<div class="col-md-4 text-center p-2">
			<img src="{{asset('images/w-events/'.$wevent->image)}}" class="w-100 h-75" alt="">
			<p class="mt-2">{!! $wevent->description !!}</p>
		</div>
		@endforeach
		@endif
	</div>
	<div class="container p-5" style="background-color: #333;">
		<div class="row m-0 justify-content-center">
			<div class="col-md-12">
				@if(isset($data->description)) {!!$data->description!!} @endif
			</div>

		@if(Events()->count()>0)
			@php
				$old_m_y=null;
			@endphp
			@foreach(Events() as $event)
				@php
					$month_year=$event->created_at->format('F Y')
				@endphp
			<div class="col-10 mb-3">
				@if($month_year!=$old_m_y)
				<h2 class="text-white fw-bold">{{$month_year}}</h2>
				@php($old_m_y=$month_year)
				@endif
				<div class="row m-0 bg-dark">
					<div class="col-6 text-start p-2">
						<h5 class="fw-bold m-0">{{$event->event_type}}</h5>
					</div>
					<div class="col-6 text-end p-2">
						<h5 class="fw-bold m-0">{{$event->created_at->format('D.d.M.y')}}</h5>
					</div>
				</div>
				<div class="row bg-white m-0 p-2 text-start text-dark">
					<div class="col-3">
						<img src="{{asset('images/events/'.$event->image)}}" class="w-100 h-100 rounded" alt="">
					</div>
					<div class="col-6">
						<h3 class="text-dark fw-bold">{{$event->title}}</h3>
						<p>{{$event->description}} </p>
					</div>
					<div class="col-3 text-center">
						<a href="{{$event->info_link}}" class="btn btn-block btn-info">More Info</a>
						<a href="{{$event->ticket_link}}" class="btn btn-block btn-success">Buy Tickets</a>
						<a href="{{$event->facebook_link}}" class="btn btn-block btn-warning">Facebook</a>
					</div>
				</div>
			</div>
			@endforeach
		@endif
		</div>
	</div>
</section>