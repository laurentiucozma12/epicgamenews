@extends('layout')

@section('title', ucfirst($video_game->name) . ' Video Game | Epic Game News')

@section('content')

<div class="colorlib-blog">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-8 posts-col">

				<x-posts :posts="$posts" />

			</div>

			<!-- SIDEBAR: start -->
			<div class="col-12 col-lg-4 animate-box">
				<div class="sidebar">
					
					<div class="d-none d-lg-block">
						<x-google-ads.responsive-square-ad/>					
					</div>					
					<div class="d-block d-lg-none">
						<x-google-ads.in-feed-ad/>
					</div>

					{{-- YouTube Channel - Hymerra the Barbarian --}}
					<x-blog.side-youtube/>

					<div class="d-none d-lg-block">
						<x-google-ads.responsive-square-ad/>					
					</div>					
					<div class="d-block d-lg-none">
						<x-google-ads.in-feed-ad/>
					</div>

					<x-blog.side-recent-posts :recent_posts="$recent_posts"/>

					<div class="d-block">
						<x-google-ads.in-feed-ad/>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

@endsection