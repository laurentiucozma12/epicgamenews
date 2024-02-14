@extends('layout')

@section('title', 'Epic Game News')

@section('content')

@section('search')
	<form action="{{ route('home.search') }}" method="GET">
		@csrf
		<div class="search-container">
			<input type="search" name="search" value="{{ isset($search) ? $search : '' }}" class="search" placeholder="Search">
			<i class="icon-search4 search-icon"></i>
		</div>
	</form>
@endsection

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

				{{-- YouTube Channel - Hymerra the Barbarian --}}
				<x-blog.side-youtube/>
				
			</div>
		</div>
	</div>
</div>

@endsection