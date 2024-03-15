@extends('layout')

@section('title', 'Categories | Epic Game News')

@section('content')

@section('search')
	<form action="{{ route('categories.search') }}" method="GET">
		@csrf
		<div class="search-container">
			<input type="search" name="search" value="{{ isset($search) ? $search : '' }}" class="search" placeholder="Search a category">
		</div>
	</form>	
@endsection
<div class="colorlib-blog">
	<div class="container">
        <div class="row">
            @forelse ($categories as $category)                
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="{{ route('categories.show', $category) }}">
                    <figure class="image-container">
                        <picture>
                            <source class="image-category" media="(min-width: 1024px)" sizes="342px" srcset="{{ asset($category->image ? 'storage/images/342x192/' . $category->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}">
                            <source class="image-category" media="(min-width: 400px)" sizes="764px" srcset="{{ asset($category->image ? 'storage/images/764x431/' . $category->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}" loading="{{ ($loop->index > 2) ? 'lazy' : '' }}">
                            <source class="image-category" media="(min-width: 300px)" sizes="400px" srcset="{{ asset($category->image ? 'storage/images/400x225/' . $category->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}" loading="{{ ($loop->index > 3) ? 'lazy' : '' }}">
                            <source class="image-category" media="(min-width: 0px)" sizes="300px" srcset="{{ asset($category->image ? 'storage/images/300x169/' . $category->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}" loading="{{ ($loop->index > 4) ? 'lazy' : '' }}">
                            @if ($category->image)
                                <img class="image-category" src="{{ asset('storage/images/342x192/' . $category->image->name) }}" width="342" height="192" alt="{{ $category->image->name }}">
                            @else
                                <img src="{{ asset('storage/placeholders/thumbnail_placeholder.jpg') }}" alt="Thumbnail Placeholder">
                            @endif
                        </picture>
                        <div class="overlay"></div>
                    </figure>
                    <figcaption class="text-container">
                        <h3 class="heading">{{ $category->name }}</h3>
                    </figcaption>
                </a>
            </div>
            @empty
                <p class="lead">There are no Video Games to show.</p>
            @endforelse   
        </div>
        <div class="page-number-container">
            {{ $categories->onEachSide(1)->links('pagination::bootstrap-4') }}
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