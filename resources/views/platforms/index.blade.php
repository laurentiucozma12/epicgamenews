@extends('layout')

@section('title', 'Platforms | Epic Game News')

@section('content')

<div class="colorlib-blog">
	<div class="container">
		<div class="row">
			<div class="col-md-12 categories-col">

                <div class="row">
                    @forelse ($platforms as $platform)
                        <div class='col-md-3'>
                            <div class="block-21 d-flex animate-box post">
                                <div class="text category-container">
                                    <h3 class="heading"><a href="{{ route('platforms.show', $platform) }}"> {{ $platform->name }} </a></h3>
                                    <div class="meta">
                                        <div><a class='date' href="#"><span class="icon-calendar"></span> {{ $platform->created_at->diffForHumans() }} </a></div>
                                        <br>
                                        <div><a href="#"><span class="icon-user2"></span> {{ $platform->user->name }} </a></div>
                                        <br>
                                        <div class="posts-count">
                                            <a href="{{ route('platforms.show', $platform) }}">
                                                <span class="icon-tag"></span> {{ $platform->posts_count . (($platform->posts_count === 1) ? ' Article' : ' Articles') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="lead">There are no platforms to show.</p>
                    @endforelse
                    
                </div>

				{{ $platforms->onEachSide(1)->links('pagination::bootstrap-4') }}

			</div>
		</div>
	</div>
</div>

@endsection