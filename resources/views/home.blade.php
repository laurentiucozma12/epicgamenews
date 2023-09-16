@extends('layout')

@section('title', 'Epic Game News')

@section('content')

<div class="colorlib-blog">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-9 posts-col">

				@forelse ($posts as $post)
					<div class="block-21 d-flex animate-box post blog-container">
						<a 
						href="{{ route('show', $post) }}" 
						class="blog-img"
						style="background-image: url({{ asset( 'storage/' .$post->image->path. '' ) }});"></a>
						<div class="text articles-container">
							<h3 class="heading"><a href="{{ route('show', $post) }}"> {{ $post->title }} </a></h3>
							<p class="excerpt"> {{ \Str::limit($post->excerpt, 150) }} </p>
							<div class="meta">
								<div><a class='date' href="#"><span class="icon-calendar"></span> {{ $post->created_at->diffForHumans() }} </a></div>
								<div><a href="#"><span class="icon-user2"></span> {{ $post->author->name }} </a></div>
								<div class="comments-count">
									<a href="{{ route('show', $post) }}#post-comments">
										<span class="icon-chat"></span> {{ $post->comments_count }} 
									</a>
								</div>
							</div>
						</div>
					</div>		
				@empty
					<p class="lead">There are no posts yet.</p>
				@endforelse

				{{ $posts->onEachSide(1)->links('pagination::bootstrap-4') }}

			</div>

			<!-- SIDEBAR: start -->
			<div class="col-12 col-md-3 animate-box">
				<div class="sidebar">
				
					<x-blog.side-categories :categories="$categories"/>

				</div>
			</div>
		</div>
	</div>
</div>

@endsection