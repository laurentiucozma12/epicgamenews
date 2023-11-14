@props(['posts'])

@forelse ($posts as $post)
<div class="post-container">
    <a 
    href="{{ route('show', $post) }}" 
    class="link-img">
        <img src="{{ $post->image ? asset('storage/' . $post->image->path) : asset('storage/placeholders/thumbnail_placeholder.jpg') }}" class="post-thumbnail" alt="{{ $post->image->name }}" title="title {{ $post->image->name }}" loading="lazy">	
    </a>
    <div class="text">
        <div>
            <h3 class="heading"><a href="{{ route('show', $post) }}"><b> {{ ucfirst($post->title) }} </b></a></h3>
            <p class="excerpt"> {{ ucfirst(\Str::limit($post->excerpt, 150)) }} </p>
        </div>
        <div class="container-meta">
            <div class="meta">
                <div><span class='author cursor-pointer'><span class="icon-user2"></span> By {{ $post->author->name }} </span></div>
                <div><span class='date cursor-pointer'><span class="icon-calendar"></span> {{ $post->created_at->diffForHumans() }} </span></div>
            </div>
        </div>
    </div>
</div>		
<hr>
@empty
<p class="lead">There are no posts yet.</p>
@endforelse

{{ $posts->onEachSide(0)->links('pagination::bootstrap-4') }}