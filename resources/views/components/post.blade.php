@extends('layout')

@section('title', ucfirst($post->title) . ' | Epic Game News')

@section('content')

    @section('search')
        <form action="{{ route('home.search') }}" method="GET">
            @csrf
            <div class="search-container">
                <input type="search" name="search" value="{{ isset($search) ? $search : '' }}" class="search" placeholder="Search">
            </div>
        </form>
    @endsection

    <div class="container single-post-container">

        <div class="row">
            <div class="col-12">
                <h1 class="post-title"><b>{{ ucfirst($post->title) }}<b></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <p class="post-excerpt">{{ ucfirst($post->excerpt) }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <span class="post-author-date">By {{ $post->author->name }}, Published {{ $post->created_at->diffForHumans() }}</span>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <figure class="animate-box thumbnail-container">
                    <picture>
                        <source media="(min-width: 1024px)" sizes="1140px" srcset="{{ asset($post->image ? 'storage/images/1140x641/' . $post->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}">
                        <source media="(min-width: 768px)" sizes="943px" srcset="{{ asset($post->image ? 'storage/images/943x530/' . $post->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}">
                        <source media="(min-width: 481px)" sizes="767px" srcset="{{ asset($post->image ? 'storage/images/764x431/' . $post->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}">
                        <source media="(min-width: 0px)" sizes="480px" srcset="{{ asset($post->image ? 'storage/images/480x270/' . $post->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}">
                        <img src="{{ asset($post->image ? 'storage/images/1140x641/' . $post->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}" width="1800" height="900" alt="{{ $post->image->name }}" class="post-img">
                        @if ($post->author_thumbnail) <figcaption class="author-credit">{{ $post->author_thumbnail }}</figcaption> @endif
                    </picture>      
                </figure>
            </div>
        </div>
        
        <div class="row">
            
            <div class="col-12 col-lg-8">
                <div class="row">
                    <div class="col-12 animate-box">
                        <div class="classes class-single">
                            <div class="desc desc2">
                                {!! $post->body !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 animate-box sidebar-container">
                <div class="sidebar">

                    <div class="d-none d-lg-block">
                        <x-google-ads.responsive-square-ad/>                 
                    </div>

					<x-blog.side-recent-posts :recent_posts="$recent_posts"/>

                    <x-blog.side-tags :tags="$tags"/>

                </div>
            </div>
        </div>

        <div class="row">           
            <div class="col-12">                
                <x-google-ads.in-vertical-ad/>
            </div>
        </div>

    </div>
    
@endsection

@section('customjs')
    
@endsection