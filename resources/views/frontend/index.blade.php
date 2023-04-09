@extends('include.master')
@section('title')
Home | Dante NYC
@endsection
  @section('content')
  
    <div class="site-content">
			<main class="site-content__main page-id--635812">
				<h1 class="sr-only">Home</h1>
				<span id="main-content" class="sr-only">Main content starts here, tab to start navigating</span>
				
				@if($page->slider_banner_type=="banner")
					@include('frontend.blocks.banner', ['banner'=>$page->banner])
				@endif




					@include('frontend.blocks.ranking')
					@include('frontend.blocks.book-table')
					@include('frontend.blocks.celebrate')
					@include('frontend.blocks.shop')
					@include('frontend.blocks.food-drink')
			</main>
		</div>
@endsection
