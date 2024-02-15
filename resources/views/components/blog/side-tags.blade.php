<h3 class="tag-sm-sc">Tags</h3>
<div class="side">
    <h3 class="sidbar-heading tags-big-title tag-big-sc">Tags</h3>
    <div class="block-26">
        <ul>
            @foreach ($tags as $tag)
                <li><a href="{{ route('tags.show', $tag->slug) }}"> {{ $tag->name }} </a></li>								
            @endforeach
        </ul>
    </div>
</div>