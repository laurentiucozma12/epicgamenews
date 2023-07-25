@props(['recent_posts'])

<div class="side">
    <h3 class="sidebar-heading">Recent News</h3>

    @foreach($recent_posts as $recent_post)
        <div class="f-blog">
            <a 
            href="{{ route('posts.show', $recent_post) }}" 
            class="blog-img" 
            style="background-image: url({{ asset( 'storage/' . $recent_post->image->path. '' ) }});">
            </a>
            <div class="desc">
                <h2>
                    <a href="blog.html"> 
                        {{ \Str::limit($recent_post->title, 10) }}									
                    </a>
                </h2>
                <p> {{ \Str::limit($recent_post->excerpt, 20) }} </p>
                <p class="admin"><span> {{ $recent_post->created_at->diffForHumans() }} </span></p>
            </div>
        </div>
    @endforeach
</div>