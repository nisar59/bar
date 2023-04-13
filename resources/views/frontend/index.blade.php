@extends('include.master')
@section('title')
Home | Dante NYC
@endsection
  @section('content')
  
    <div class="site-content">
    	<div class="site-header-spacer-desktop" aria-hidden="true"></div><div class="site-header-spacer-mobile" aria-hidden="true" style="height:62.125px;"></div>
			<main class="site-content__main">
				
				@if($page->slider_banner_type=="banner")
					@include('frontend.blocks.banner', ['banner'=>$page->banner])
				@endif

				@if($page->slider_banner_type=="slider")
					@include('frontend.blocks.slider', ['slider'=>$page->slider])
				@endif

				@if($page->blocks!=null)
					@foreach($page->blocks as $block)
						@php
							$nme=$block->block_name;
							$file_name=config('page-blocks')->$nme;
						@endphp
						@include('frontend.blocks.'.$file_name['name'], ['data'=>	$block->data])
					@endforeach
				@endif

			</main>
		</div>
@endsection
