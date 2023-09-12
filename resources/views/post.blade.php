@extends('layout')

@section('title', $post->title . ' | Epic Game News')

@section('custom_css')
    
    <style>
        .class-single .desc img {
            width: 100%;
        }
    </style>

@endsection

@section('content')

<div class="colorlib-classes">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $post->title }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>{{ $post->excerpt }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <span> By {{ $post->author->name }} Published {{ $post->created_at->diffForHumans() }} </span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="animate-box thumbnail-container">
                    <img style="display: block; height: auto; max-width: 100%; background-image: url('{{ asset($post->image ? 'storage/' . $post->image->path : 'storage/placeholders/thumbnail_placeholder.svg') }}'); background-repeat: no-repeat; background-size: cover; width: 1800px; height: 900px;" />
                </div>
            </div>

        </div>
        <div class="row">
            
            <div class="col-md-8">
                <div class="row row-pb-lg">
                    <div class="col-md-12 animate-box">
                        <div class="classes class-single">
                            <div class="desc desc2">
                                {!! $post->body !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-pb-lg animate-box">
                    <div class="col-md-12">

                        <h2 class="colorlib-heading-2">{{ count($post->comments) }} Comments</h2>

                        @foreach($post->comments as $comment)

                            <div class="comment-container">
                                <div id="comment_{{ $comment->id }}" class="review">
                                    <img class="user-img" style="background-image: url({{ $comment->user->image ? asset('storage/' . $comment->user->image->path. '') : 'storage/placeholders/user_placeholder.jpg' }});" />
                                </div>

                                <div class="desc">
                                        <h4>
                                            <span class="text-left">{{ $comment->user->name }}</span>
                                            <span class="text-right">{{ $comment->created_at->diffForHumans() }}</span>
                                        </h4>
                                        <p>{{ $comment->the_comment }}</p>
                                        {{-- <p class="star">
                                            <span class="text-left"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                                        </p> --}}
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>
        
                <div class="row animate-box">
                    <div class="col-md-12">

                        <x-blog.message :status="'success'"/>

                        <h2 class="colorlib-heading-2">Comments</h2>
                        
                        @auth
                            <form  autocomplete="off" method="POST" action="{{ route('add_comment', $post) }}">
                                @csrf
                                
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <x-blog.form.textarea value='{{ old("the_comment") }}' name="the_comment" id="the_comment" cols="30" rows="10" class="form-control" placeholder="Comment to this post" />
                                        <small class='error text-danger the_comment'></small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Post Comment" class="btn btn-primary">
                                </div>
                            </form>

                            <x-blog.message :status="'success'" />
                        @endauth

                        @guest
                            <p class="lead"><a href="{{ route('login') }}">Login </a> OR <a href="{{ route('register') }}">Register</a> to write comments</p>
                        @endguest
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
</div>
@endsection

@section('customjs')
    
@endsection