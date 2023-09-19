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
                                <div class="text category-container">
                                    <h3 class="heading"><a href="{{ route('video_games.show', $video_game) }}"> {{ $video_game->name }} </a></h3>
                                    <div class="meta">
                                        <div><a class='date' href="#"><span class="icon-calendar"></span> {{ $video_game->created_at->diffForHumans() }} </a></div>
                                        <br>
                                        <div><a href="#"><span class="icon-user2"></span> {{ $video_game->user->name }} </a></div>
                                        <br>
                                        <div class="posts-count">
                                            <a href="{{ route('video_games.show', $video_game) }}">
                                                <span class="icon-tag"></span> {{ $video_game->posts_count . (($video_game->posts_count === 1) ? ' Article' : ' Articles') }}
                                            </a>
                                        </div>
                                    </div>
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