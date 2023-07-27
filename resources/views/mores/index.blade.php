@extends('layout')

@section('title', 'More | New Gaming News')

@section('content')

<div class="colorlib-blog">
	<div class="container">
		<div class="row">
			<div class="col-md-12 mores-col">

                <div class="row">

                    @forelse ($mores as $more)
                        <div class='col-md-3'>
                            <div class="block-21 d-flex animate-box post">
                                <div class="text">

                                    <h3 class="heading"><a href="{{ route('mores.show', $more) }}"> {{ $more->name }} </a></h3>
                                    <div class="meta">
                                        <div><a class='date' href="#"><span class="icon-calendar"></span> {{ $more->created_at->diffForHumans() }} </a></div>
                                        <div><a href="#"><span class="icon-user2"></span> {{ $more->user->name }} </a></div>
                                        <div class="posts-count">
                                            <a href="{{ route('mores.show', $more) }}">
                                                <span class="icon-tag"></span> {{ $more->posts_count }}
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="lead">There is no more to show.</p>
                    @endforelse
                    
                </div>

                {{ $mores->links() }}

			</div>
		</div>
	</div>
</div>

@endsection