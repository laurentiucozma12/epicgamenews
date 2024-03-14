@extends('layout')

@section('title', 'Video Games | Epic Game News')

@section('content')

@section('search')
	<form action="{{ route('video_games.search') }}" method="GET">
		@csrf
		<div class="search-container">
			<input type="search" name="search" value="{{ isset($search) ? $search : '' }}" class="search" placeholder="Search a video game">
		</div>
	</form>	
@endsection
<div class="colorlib-blog">
	<div class="container">
        <div class="row">
            @forelse ($video_games as $video_game)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="{{ route('video_games.show', $video_game) }}">
                        <figure class="overlay-container">
                            @if ($video_game->image)
                                <img class="image-category" src="{{ asset('storage/images/300x169/' . $video_game->image->name) }}" width="300" height="169" alt="{{ $video_game->image->name }}">
                            @else
                                <img src="{{ asset('storage/placeholders/thumbnail_placeholder.jpg') }}" alt="Thumbnail Placeholder">
                            @endif
                            <figcaption class="text-container">
                                <h3 class="heading">{{ $video_game->name }}</h3>
                            </figcaption>
                        </figure>
                    </a>
                </div>
            @empty
                <p class="lead">There are no Video Games to show.</p>
            @endforelse   
        </div>
    </div>
    {{ $video_games->onEachSide(1)->links('pagination::bootstrap-4') }}
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