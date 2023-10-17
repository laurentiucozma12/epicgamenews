@extends('layout')

@section('title', ucfirst($category->name) . ' Category | Epic Game News')

@section('content')

<div class="colorlib-blog">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-8 posts-col">
				
				<x-posts :posts="$posts" />

			</div>

			<!-- SIDEBAR: start -->
			<div class="col-12 col-lg-4 animate-box">
				<div class="sidebar">

					<x-blog.side-ads/>
					
					<x-blog.side-recent-posts :recent_posts="$recent_posts"/>

				</div>
			</div>
		</div>
	</div>
</div>

@endsection