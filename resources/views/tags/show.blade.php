@extends('layout')

@section('title', ucfirst($tag->name) . ' Tag | Epic Game News')

@section('content')

<div class="colorlib-blog">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-8 posts-col">

				@forelse ($posts as $post)
					<div class="post-container">
						<a 
						href="{{ route('show', $post) }}" 
						class="link-img">
							<img src="{{ asset($post->image ? 'storage/' . $post->image->path : 'storage/placeholders/thumbnail_placeholder.jpg') }}" class="post-thumbnail" alt="thumbnail post"></a>
						<div class="text">
							<div>
								<h3 class="heading"><a href="{{ route('show', $post) }}"><b> {{ $post->title }} </b></a></h3>
								<p class="excerpt"> {{ \Str::limit($post->excerpt, 150) }} </p>
							</div>
							<div class="container-meta">
								<div class="meta">
									<div><a class='author cursor-pointer'><span class="icon-user2"></span> By {{ $post->author->name }} </a></div>
									<div><a class='date cursor-pointer'><span class="icon-calendar"></span> {{ $post->created_at->diffForHumans() }} </a></div>
								</div>
							</div>
						</div>
					</div>		
					<hr>	
				@empty
					<p>There are no posts related to this tag</p>
				@endforelse

				{{ $posts->onEachSide(0)->links('pagination::bootstrap-4') }}

			</div>

			<!-- SIDEBAR: start -->
			<div class="col-12 col-lg-4 animate-box">
				<div class="sidebar">

					<div class="d-none d-lg-block">
						<x-google-ads.responsive-square-ad/>					
					</div>					
					<div class="d-block d-lg-none">
						<x-google-ads.in-feed-ad/>
					</div>

					<x-blog.side-ads-meme/>

					<div class="d-none d-lg-block">
						<x-google-ads.responsive-square-ad/>					
					</div>					
					<div class="d-block d-lg-none">
						<x-google-ads.in-feed-ad/>
					</div>

					<x-blog.side-recent-posts :recent_posts="$recent_posts"/>

					<div class="d-block">
						<x-google-ads.in-feed-ad/>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

@endsection