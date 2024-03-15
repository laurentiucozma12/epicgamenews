@extends('layout')

@section('title', 'Platforms | Epic Game News')

@section('content')

@section('search')
	<form action="{{ route('platforms.search') }}" method="GET">
		@csrf
		<div class="search-container">
			<input type="search" name="search" value="{{ isset($search) ? $search : '' }}" class="search" placeholder="Search a platform">
		</div>
	</form>	
@endsection
<div class="colorlib-blog">
	<div class="container">
        <div class="row">
            @forelse ($platforms as $platform)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="{{ route('platforms.show', $platform) }}">
                        <figure class="image-container">
                            <picture>
                                <source class="image-category" media="(min-width: 1024px)" sizes="342px" srcset="{{ asset($platform->image ? 'storage/images/342x192/' . $platform->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}">
                                <source class="image-category" media="(min-width: 400px)" sizes="764px" srcset="{{ asset($platform->image ? 'storage/images/764x431/' . $platform->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}" loading="{{ ($loop->index > 2) ? 'lazy' : '' }}">
                                <source class="image-category" media="(min-width: 300px)" sizes="400px" srcset="{{ asset($platform->image ? 'storage/images/400x225/' . $platform->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}" loading="{{ ($loop->index > 3) ? 'lazy' : '' }}">
                                <source class="image-category" media="(min-width: 0px)" sizes="300px" srcset="{{ asset($platform->image ? 'storage/images/300x169/' . $platform->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}" loading="{{ ($loop->index > 4) ? 'lazy' : '' }}">
                                @if ($platform->image)
                                    <img class="image-category" src="{{ asset('storage/images/342x192/' . $platform->image->name) }}" width="342" height="192" alt="{{ $platform->image->name }}">
                                @else
                                    <img src="{{ asset('storage/placeholders/thumbnail_placeholder.jpg') }}" alt="Thumbnail Placeholder">
                                @endif
                            </picture>
                            <div class="overlay"></div>
                        </figure>
                        <figcaption class="text-container">
                            <h3 class="heading">{{ $platform->name }}</h3>
                        </figcaption>
                    </a>
                </div>
            @empty
                <p class="lead">There are no Video Games to show.</p>
            @endforelse   
        </div>
        <div class="page-number-container">
            {{ $platforms->onEachSide(1)->links('pagination::bootstrap-4') }}
        </div>
    </div>
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
@endsection