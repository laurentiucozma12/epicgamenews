@props(['recent_posts'])

<div class="side">
    <div>
        <h2 class="recent-news-big-title">Recent News</h2>

        @foreach($recent_posts as $recent_post)
            <div class="f-blog recent-news-container">
                <div class="img-and-title-container-recent-news">
                    <a 
                    href="{{ route('show', $recent_post) }}" 
                    class="blog-img recent-news-img">

                        <img src="{{ $recent_post->image ? asset('storage/' . $recent_post->image->path) : asset('storage/placeholders/thumbnail_placeholder.jpg') }}" width="80" height="50" alt="{{ $recent_post->image->name }}" title="title {{ $recent_post->image->name }}" /> 

                    </a>            
                    <h3 class="fw-bold">
                        <a href="{{ route('show', $recent_post) }}" class="recent-news-title"> 
                            {{ \Str::limit($recent_post->title, 35) }}									
                        </a>
                    </h3>
                </div>  
                <div class="desc">
                    <p> {{ \Str::limit($recent_post->excerpt, 66) }} </p>
                    <p class="date"><span> {{ $recent_post->created_at->diffForHumans() }} </span></p>
                </div>
            </div>
        @endforeach
    </div>
</div>