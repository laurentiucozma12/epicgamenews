@extends('layout')

@section('title', 'Epic Game News')

@section('content')

<div class="colorlib-blog">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-8 posts-col">

				<x-posts :posts="$posts" />

			</div>			
			<div class="col-12 col-lg-4">
				
				<x-blog.side-ads/>
				
			</div>
		</div>
	</div>
</div>

@endsection