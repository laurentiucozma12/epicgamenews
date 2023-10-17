@extends('layout')

@section('title', 'Epic Game News')

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
							<img width="291" height="164" src="{{ $post->image ? asset('storage/' . $post->image->path) : asset('storage/placeholders/thumbnail_placeholder.jpg') }}" class="post-thumbnail" alt="post thumbnail">						
						</a>
						<div class="text">
							<div>
								<h3 class="heading"><a href="{{ route('show', $post) }}"><b> {{ ucfirst($post->title) }} </b></a></h3>
								<p class="excerpt"> {{ ucfirst(\Str::limit($post->excerpt, 150)) }} </p>
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
					<p class="lead">There are no posts yet.</p>
				@endforelse

				{{ $posts->onEachSide(0)->links('pagination::bootstrap-4') }}

			</div>			
			<div class="col-12 col-lg-4">
				
				<x-blog.side-ads/>
				
			</div>
		</div>
	</div>
</div>

@endsection