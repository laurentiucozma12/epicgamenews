@extends('layout')

@section('title', 'Epic Game News')

@section('content')

<div class="colorlib-blog">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-8 posts-col">

				<x-posts :posts="$posts" />

				<div class="d-block">
					<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7545576639006325" crossorigin="anonymous"></script>
					<!-- In-Feed Ad -->
					<ins class="adsbygoogle"
						style="display:block"
						data-ad-format="fluid"
						data-ad-layout-key="-5q+dg+6v-f0-ap"
						data-ad-client="ca-pub-7545576639006325"
						data-ad-slot="2658029912"></ins>
					<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
					</script>
				</div>

			</div>			
			<div class="col-12 col-lg-4">
				
				<div class="d-none d-lg-block">
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
				</div>
				
				<x-blog.side-ads/>
				
			</div>
		</div>
	</div>
</div>

@endsection