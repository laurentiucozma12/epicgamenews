@extends('layout')

@section('title', $other->name . ' | Epic Game News')

@section('content')

<div class="colorlib-blog">
	<div class="container">
		<div class="row">
			<div class="col-md-9 posts-col">
				
				@forelse ($posts as $post)
					<div class="post-container">
						<a 
						href="{{ route('show', $post) }}" 
						class="link-img">
						<img src="{{ asset( 'storage/' .$post->image->path. '' ) }}" class="post-thumbnail" alt=""></a>
						<div class="text">
							<h3 class="heading"><a href="{{ route('show', $post) }}"> {{ $post->title }} </a></h3>
							<p class="excerpt"> {{ \Str::limit($post->excerpt, 150) }} </p>
							<div class="container-meta">
								<div class="meta">
									<div><a class='author cursor-pointer'><span class="icon-user2"></span> By {{ $post->author->name }} </a></div>
									<div><a class='date cursor-pointer'><span class="icon-calendar"></span> {{ $post->created_at->diffForHumans() }} </a></div>
									<div class="comments-count">
										<a href="{{ route('show', $post) }}#post-comments">
											<span class="icon-chat"></span> {{ $post->comments_count }} 
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>		
					<hr>
				@empty
					<p class="lead">There are no posts yet.</p>
				@endforelse

				{{ $posts->onEachSide(0)->links('pagination::bootstrap-4') }}

			</div>

			<!-- SIDEBAR: start -->
			<div class="col-md-3 animate-box">
				<div class="sidebar">
				
					<x-blog.side-categories :categories="$categories"/>

					<x-blog.side-recent-posts :recent_posts="$recent_posts"/>

				</div>
			</div>
		</div>
	</div>
</div>

@endsection