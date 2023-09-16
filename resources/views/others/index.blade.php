@extends('layout')

@section('title', 'Other | Epic Game News')

@section('content')

<div class="colorlib-blog">
	<div class="container">
		<div class="row">
			<div class="col-md-12 categories-col">

                <div class="row">
                    @forelse ($others as $other)
                        <div class='col-md-3'>
                            <div class="block-21 d-flex animate-box post">
                                <div class="text category-container">
                                    <h3 class="heading"><a href="{{ route('others.show', $other) }}"> {{ $other->name }} </a></h3>
                                    <div class="meta">
                                        <div><a class='date' href="#"><span class="icon-calendar"></span> {{ $other->created_at->diffForHumans() }} </a></div>
                                        <br>
                                        <div><a href="#"><span class="icon-user2"></span> {{ $other->name }} </a></div>
                                        <br>
                                        <div class="posts-count">
                                            <a href="{{ route('others.show', $other) }}">
                                                <span class="icon-tag"></span> {{ $other->posts_count . (($other->posts_count === 1) ? ' Article' : ' Articles') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="lead">There is no other to show.</p>
                    @endforelse
                    
                </div>

				{{ $others->onEachSide(1)->links('pagination::bootstrap-4') }}

			</div>
		</div>
	</div>
</div>

@endsection