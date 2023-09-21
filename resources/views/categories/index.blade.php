@extends('layout')

@section('title', 'Categories | Epic Game News')

@section('content')

<div class="colorlib-blog">
	<div class="container">
		<div class="row">
			<div class="col-md-12 categories-col">

                <div class="row">

                    @forelse ($categories as $category)
                        <div class='col-md-3'>
                            <div class="block-21 d-flex animate-box post">

                                <div class="category-container">
                                    <a href="{{ route('categories.show', $category) }}">
                                        <div class="image-container">
                                            <img src="{{ asset( 'storage/' .$category->image->path. '') }}">
                                        </div>
                                        <div class="text-container">
                                            <h3 class="heading">{{ $category->name }}</h3>
                                            <div class="meta">
                                                <div class="posts-count">
                                                    <span class="icon-tag"></span> {{ $category->posts_count . (($category->posts_count === 1) ? ' Article' : ' Articles') }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @empty
                        <p class="lead">There are no categories to show.</p>
                    @endforelse
                    
                </div>

				{{ $categories->onEachSide(1)->links('pagination::bootstrap-4') }}

			</div>
		</div>
	</div>
</div>

@endsection