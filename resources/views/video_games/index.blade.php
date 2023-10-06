@extends('layout')

@section('title', 'Video Games | Epic Game News')

@section('content')

<div class="colorlib-blog">
	<div class="container">
		<div class="row">
			<div class="col-md-12 categories-col">

                <div class="row">

                    @forelse ($video_games as $video_game)
                        <div class='col-md-3'>
                            <div class="block-21 d-flex animate-box post">

                                <div class="category-container">
                                    <a href="{{ route('video_games.show', $video_game) }}">
                                        <div class="image-container">
                                            <img src="{{ asset($video_game->image ? 'storage/' . $video_game->image->path : 'storage/placeholders/thumbnail_placeholder.jpg') }}">                                            
                                        </div>
                                        <div class="text-container">
                                            <h3 class="heading">{{ $video_game->name }}</h3>
                                            <div class="meta">
                                                <div class="posts-count">
                                                    <span class="icon-tag"></span> {{ $video_game->posts_count . (($video_game->posts_count === 1) ? ' Article' : ' Articles') }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @empty
                        <p class="lead">There are no Video Games to show.</p>
                    @endforelse
                    
                </div>

				{{ $video_games->onEachSide(1)->links('pagination::bootstrap-4') }}

			</div>
		</div>
	</div>
</div>

@endsection