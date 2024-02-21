<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($posts as $post)
        <url>
            <loc>{{ url('/') }}/{{ $post->slug }}</loc>
            <lastmod>{{ $post->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
    @foreach ($video_games as $video_game)
        <url>
            <loc>{{ url('/') }}/video-games/{{ $video_game->slug }}</loc>
            <lastmod>{{ $video_game->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
    @foreach ($categories as $category)
        <url>
            <loc>{{ url('/') }}/categories/{{ $category->slug }}</loc>
            <lastmod>{{ $category->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
    @foreach ($platforms as $platform)
        <url>
            <loc>{{ url('/') }}/platforms/{{ $platform->slug }}</loc>
            <lastmod>{{ $platform->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>