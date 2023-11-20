@extends('layout')

@section('title', ucfirst($post->title) . ' | Epic Game News')

@section('content')

    <div class="container single-post-container">

        <div class="row">
            <div class="col-12">
                <h1><b>{{ ucfirst($post->title) }}<b></h1>
            </div>
        </div> {{-- End of row --}}

        <div class="row">
            <div class="col-12">
                <p>{{ ucfirst($post->excerpt) }}</p>
            </div>
        </div> {{-- End of row --}}

        <div class="row">
            <div class="col-12">
                <span class="single-post-author-time">BY {{ strtoupper($post->author->name) }}, PUBLISHED {{ strtoupper($post->created_at->diffForHumans()) }}</span>
            </div>
        </div> {{-- End of row --}}

        <div class="row">
            <div class="col-12">
                <figure class="animate-box thumbnail-container">			
                    <img src="{{ $post->image ? asset('storage/' . $post->image->path) : asset('storage/placeholders/thumbnail_placeholder.jpg') }}" width="1800" height="900" alt="{{ $post->image->name }}" title="title {{ $post->image->name }}" /> 
                    @if ($post->author_thumbnail) <figcaption class="author-credit">{{ $post->author_thumbnail }}</figcaption> @endif
                </figure>
            </div>
        </div> {{-- End of row --}}
        
        <div class="row">
            
            <div class="col-md-8">
                <div class="row row-pb-lg">
                    <div class="col-12 animate-box">
                        <div class="classes class-single">
                            <div class="desc desc2">
                                {!! $post->body !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div> {{-- End of row --}}

            <!-- SIDEBAR: start -->
            <div class="col-md-4 animate-box">
                <div class="sidebar">

                    <div class="d-none d-lg-block">
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7545576639006325" crossorigin="anonymous"></script>
                        <!-- Responsive Square Ad -->
                        <ins class="adsbygoogle"
                            style="display:block"
                            data-ad-client="ca-pub-7545576639006325"
                            data-ad-slot="7659623891"
                            data-ad-format="auto"
                            data-full-width-responsive="true">
                        </ins>
                        <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>                   
                    </div>

					<x-blog.side-recent-posts :recent_posts="$recent_posts"/>

					<x-blog.side-tags :tags="$tags"/>
					
                </div>
            </div>
        </div> {{-- End of row --}}

        <div class="row">           
            <div class="col-12">
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7545576639006325" crossorigin="anonymous"></script>
                <!-- In Article Ad -->
                <ins class="adsbygoogle"
                style="display:block; text-align:center;"
                data-ad-layout="in-article"
                data-ad-format="fluid"
                data-ad-client="ca-pub-7545576639006325"
                data-ad-slot="8944785409"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div> {{-- End of row --}}

    </div>
    
@endsection

@section('customjs')
    
@endsection