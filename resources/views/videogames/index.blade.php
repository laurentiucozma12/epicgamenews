@extends('layout')

@section('title', 'Video Games | Epic Game News')

@section('content')

<div class="colorlib-blog">
	<div class="container">
		<div class="row">
			<div class="col-md-12 categories-col">

                <div class="row">

                    @forelse ($videoGames as $videoGame)
                        <div class='col-md-3'>
                            <div class="block-21 d-flex animate-box post">
                                <div class="text category-container">
                                    <h3 class="heading"><a href="{{ route('videogames.show', $videoGame) }}"> {{ $videoGame->name }} </a></h3>
                                    <div class="meta">
                                        <div><a class='date' href="#"><span class="icon-calendar"></span> {{ $videoGame->created_at->diffForHumans() }} </a></div>
                                        <br>
                                        <div><a href="#"><span class="icon-user2"></span> {{ $videoGame->user->name }} </a></div>
                                        <br>
                                        <div class="posts-count">
                                            <a href="{{ route('videogames.show', $videoGame) }}">
                                                <span class="icon-tag"></span> {{ $videoGame->posts_count . (($videoGame->posts_count === 1) ? ' Article' : ' Articles') }}
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

				{{ $videoGames->onEachSide(1)->links('pagination::bootstrap-4') }}

			</div>
		</div>
	</div>
</div>

@endsection