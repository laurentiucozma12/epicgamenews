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
                        <figure class="overlay-container">
                            @if ($category->image)
                                <img class="image-category" src="{{ asset('storage/images/300x169/' . $category->image->name) }}" alt="{{ $category->image->name }}">
                            @else
                                <img src="{{ asset('storage/placeholders/thumbnail_placeholder.jpg') }}" alt="Thumbnail Placeholder">
                            @endif
                        <figcaption class="text-container">
                            <h3 class="heading">{{ $category->name }}</h3>
                        </figcaption>
                        </figure>
                    </a>
                </div>
            @empty
                <p class="lead">There are no Video Games to show.</p>
            @endforelse   
        </div>
    </div>
    {{ $categories->onEachSide(1)->links('pagination::bootstrap-4') }}
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