@extends('layout')

@section('title', 'About | Epic Game News')

@section('content')

@section('search')
	<form action="{{ route('home.search') }}" method="GET">
		@csrf
		<div class="search-container">
			<input type="search" name="search" value="{{ isset($search) ? $search : '' }}" class="search" placeholder="Search">
		</div>
	</form>
@endsection

<div class="colorlib-blog">
    <div class="container">

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="who-are-we-container">
                    {!! $about->description !!}
                </div>
            </div>

            <div class="col-12 col-lg-4">
                {{-- YouTube Channel - Hymerra the Barbarian --}}
                <x-blog.side-youtube/>
            </div>
        </div>

        <div class="d-block">
            <x-google-ads.multiplex-ad/>
        </div>

    </div>
</div>
@endsection