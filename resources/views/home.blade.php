@extends('layout')

@section('title', 'New Gaming News')

@section('content')

<div class="colorlib-blog">
	<div class="container">
		<div class="row">
			<div class="col-md-8 posts-col">
 
				@forelse ($posts as $post)
					<div class="block-21 d-flex animate-box post">
						<a 
						href="{{ route('show', $post) }}" 
						class="blog-img"
						style="background-image: url({{ asset( '/' .$post->image->path. '' ) }});"></a>
						<h1>TEST TEST TEST TEST</h1>
						<div class="text">
							<h3 class="heading"><a href="{{ route('show', $post) }}"> {{ $post->title }} </a></h3>
							<p class="excerpt"> {{ $post->excerpt }} </p>
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

				{{ $posts->links() }}

			</div>

			<!-- SIDEBAR: start -->
			<div class="col-md-4 animate-box">
				<div class="sidebar">
				
					<x-blog.side-categories :categories="$categories"/>

					<x-blog.side-recent-posts :recent_posts="$recent_posts"/>

					<x-blog.side-tags :tags="$tags"/>

				</div>
			</div>
		</div>
	</div>
</div>

@endsection