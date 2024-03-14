@extends('layout')

@section('title', 'Platforms | Epic Game News')

@section('content')

@section('search')
	<form action="{{ route('platforms.search') }}" method="GET">
		@csrf
		<div class="search-container">
			<input type="search" name="search" value="{{ isset($search) ? $search : '' }}" class="search" placeholder="Search a platform">
		</div>
	</form>	
@endsection
<div class="colorlib-blog">
	<div class="container">
        <div class="row">
            @forelse ($platforms as $platform)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="{{ route('platforms.show', $platform) }}">
                        <div class="image-container">
                            @if ($platform->image)
                                <img class="image-category" src="{{ asset('storage/images/300x169/' . $platform->image->name) }}" width="300" height="169" alt="{{ $platform->image->name }}">
                            @else
                                <img src="{{ asset('storage/placeholders/thumbnail_placeholder.jpg') }}" alt="Thumbnail Placeholder">
                            @endif
                            <div class="overlay"></div>
                        </div>
                        <figcaption class="text-container">
                            <h3 class="heading">{{ $platform->name }}</h3>
                        </figcaption>
                    </a>
                </div>
            @empty
                <p class="lead">There are no Video Games to show.</p>
            @endforelse   
        </div>
    </div>
    {{ $platforms->onEachSide(1)->links('pagination::bootstrap-4') }}
    <div class="row">
        <div class="col-12">  
            <div class="d-none d-md-block">
                <x-google-ads.responsive-horizontal-ad/>
            </div>
        </div>
        <div class="col-12">
            <div class="d-block d-md-none">
                <x-google-ads.in-article-ad/>
            </div>
        </div>
    </div>
</div>
@endsection