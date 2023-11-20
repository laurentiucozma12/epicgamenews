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
				
				<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7545576639006325" crossorigin="anonymous"></script>
					<!-- Responsive Square Ad -->
					<ins class="adsbygoogle"
						style="display:block"
						data-ad-client="ca-pub-7545576639006325"
						data-ad-slot="7659623891"
						data-ad-format="auto"
						data-full-width-responsive="true">
					</ins>
				<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
				
				<x-blog.side-ads/>
				
			</div>
		</div>
	</div>
</div>

@endsection