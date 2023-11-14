@extends('layout')

@section('title', ucfirst($post->title) . ' | Epic Game News')

@section('content')

    <div class="container single-post-container">
        <div class="row">
            <div class="col-12">
                <h1><b>{{ ucfirst($post->title) }}<b></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>{{ ucfirst($post->excerpt) }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <span class="single-post-author-time">BY {{ strtoupper($post->author->name) }}, PUBLISHED {{ strtoupper($post->created_at->diffForHumans()) }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <figure class="animate-box thumbnail-container">			
                    <img src="{{ $post->image ? asset('storage/' . $post->image->path) : asset('storage/placeholders/thumbnail_placeholder.jpg') }}" width="1800" height="900" alt="{{ $post->image->name }}" title="title {{ $post->image->name }}" loading="lazy"/> 
                    @if ($post->author_thumbnail) <figcaption class="author-credit">{{ $post->author_thumbnail }}</figcaption> @endif
                </figure>
            </div>

        </div>
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
            </div>

            <!-- SIDEBAR: start -->
            <div class="col-md-4 animate-box">
                <div class="sidebar">                    

					<x-blog.side-recent-posts :recent_posts="$recent_posts"/>

					<x-blog.side-tags :tags="$tags"/>
					
                </div>
            </div>
        </div>
    </div>	
    
@endsection

@section('customjs')
    
@endsection