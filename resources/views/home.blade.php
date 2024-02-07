@extends('layout')

@section('title', 'Epic Game News')

@section('content')

<div>
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-8">

				<x-posts :posts="$posts" />

				<div class="d-block">
					<x-google-ads.in-feed-ad/>
				</div>

			</div>
			<div class="col-12 col-lg-4">
				
				<div class="d-none d-lg-block">
					<x-google-ads.responsive-square-ad/>					
				</div>

				{{-- <x-blog.side-ads-meme/> --}}
				<x-blog.side-youtube/>
				
			</div>
		</div>
	</div>
</div>

@endsection