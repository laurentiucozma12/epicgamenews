@props(['posts'])

@forelse ($posts as $post)

<div class="row">
    <div class="col-sm-4">
        <a href="{{ route('show', $post) }}">
            <picture>
                <source media="(min-width: 1024px)" sizes="342px" srcset="{{ asset($post->image ? 'storage/images/342x192/' . $post->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}" loading="{{ ($loop->index > 3) ? 'lazy' : '' }}">
                <source media="(min-width: 768px)" sizes="400px" srcset="{{ asset($post->image ? 'storage/images/400x225/' . $post->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}" loading="{{ ($loop->index > 4) ? 'lazy' : '' }}">
                <source media="(min-width: 481px)" sizes="300px" srcset="{{ asset($post->image ? 'storage/images/300x169/' . $post->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}" loading="{{ ($loop->index > 5) ? 'lazy' : '' }}">
                <source media="(min-width: 0px)" sizes="146px" srcset="{{ asset($post->image ? 'storage/images/146x82/' . $post->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}" loading="{{ ($loop->index > 5) ? 'lazy' : '' }}">
                <img src="{{ asset($post->image ? 'storage/images/342x192/' . $post->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}" class="posts-img" alt="{{ $post->image->name }}">
            </picture>            
        </a>
    </div>
    <div class="col-sm-8 posts-text-container">
        <h3 class="posts-title"><a href="{{ route('show', $post) }}">{{ ucfirst($post->title) }}</a></h3></h1>
        <p class="posts-excerpt">{{ ucfirst(\Str::limit($post->excerpt, 150)) }}</p>
        <div class="posts-author-date">
            <div class="posts-author"><span><span class="icon-user2"></span> By {{ $post->author->name }} </span></div>
            <div><span><span class="icon-calendar"></span> {{ $post->created_at->diffForHumans() }} </span></div>
        </div>
    </div>
</div>
<div class="row small-screen-container">
    <p class="posts-excerpt">{{ ucfirst(\Str::limit($post->excerpt, 150)) }}</p>
    <div class="posts-author-date">
        <div class="posts-author"><span><span class="icon-user2"></span>By {{ $post->author->name }}</span></div>
        <div><span><span class="icon-calendar"></span> {{ $post->created_at->diffForHumans() }} </span></div>
    </div>
</div>
<hr>

@empty
    <p class="lead">Ops, we do not have an article related for your search</p>
@endforelse

{{ $posts->onEachSide(0)->links('pagination::bootstrap-4') }}