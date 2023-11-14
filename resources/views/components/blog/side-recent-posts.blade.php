@props(['recent_posts'])

<div class="side">
    <h3 class="sidebar-heading recent-news-big-title">Recent News</h3>

    @foreach($recent_posts as $recent_post)
        <div class="f-blog recent-news-container">
            <div class="img-and-title-container-recent-news">
                <a 
                href="{{ route('show', $recent_post) }}" 
                class="blog-img recent-news-img" 
                style="background-image: url({{ asset($recent_post->image ? 'storage/' . $recent_post->image->path : 'storage/placeholders/thumbnail_placeholder.jpg') }});">
                </a>            
                <h4 class="fw-bold">
                    <a href="{{ route('show', $recent_post) }}" class="recent-news-title"> 
                        {{ \Str::limit($recent_post->title, 35) }}									
                    </a>
                </h4>                    
            </div>  
            <div class="desc">
                <p> {{ \Str::limit($recent_post->excerpt, 66) }} </p>
                <p class="admin"><span> {{ $recent_post->created_at->diffForHumans() }} </span></p>
            </div>
        </div>
    @endforeach
</div>