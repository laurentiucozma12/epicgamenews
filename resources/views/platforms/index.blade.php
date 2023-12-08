@extends('layout')

@section('title', 'Platforms | Epic Game News')

@section('content')

<div class="colorlib-blog">
	<div class="container">
		<div class="row">
			<div class="col-md-12 categories-col">

                <div class="row">
                    @forelse ($platforms as $platform)
                        <div class='col-md-3'>
                            <div class="block-21 d-flex animate-box post">

                                <div class="category-container">
                                    <a href="{{ route('platforms.show', $platform) }}">
                                        <div class="image-container">
                                            <picture>
                                                <source media="(min-width: 1024px)" sizes="342px" srcset="{{ asset($platform->image ? 'storage/images/342x192/' . $platform->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}">
                                                <source media="(min-width: 400px)" sizes="764px" srcset="{{ asset($platform->image ? 'storage/images/764x431/' . $platform->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}" loading="{{ ($loop->index > 2) ? 'lazy' : '' }}">
                                                <source media="(min-width: 300px)" sizes="400px" srcset="{{ asset($platform->image ? 'storage/images/400x225/' . $platform->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}" loading="{{ ($loop->index > 3) ? 'lazy' : '' }}">
                                                <source media="(min-width: 0px)" sizes="300px" srcset="{{ asset($platform->image ? 'storage/images/300x169/' . $platform->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}" loading="{{ ($loop->index > 4) ? 'lazy' : '' }}">
                                                <img src="{{ asset($platform->image ? 'storage/images/342x192/' . $platform->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}" alt="{{ $platform->image->name }}">
                                            </picture>
                                        </div>
                                        <div class="text-container">
                                            <h3 class="heading">{{ $platform->name }}</h3>
                                            <div class="meta">
                                                <div class="posts-count">
                                                    <span class="icon-tag"></span> {{ $platform->posts_count . (($platform->posts_count === 1) ? ' Article' : ' Articles') }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @empty
                        <p class="lead">There are no platforms to show.</p>
                    @endforelse
                    
                </div>
                
				{{ $platforms->onEachSide(1)->links('pagination::bootstrap-4') }}

                <div class="row">
                    <div class="col-12">  
                        <div class="d-none d-md-block">
                            <x-google-ads.responsive-horizontal-ad/>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-block d-md-none">
                            <x-google-ads.in-article-ad/>
                        </div>
                    </div>
                </div>

			</div>
		</div>
	</div>
</div>

@endsection