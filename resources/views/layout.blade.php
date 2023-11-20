<!DOCTYPE HTML>
<html lang="en">
<head>	
{{-- Meta tags general --}}
<meta charset="utf-8">
<meta http-equiv="Content-Language" content="en">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="index, follow">


<link rel="canonical" href="https://epicgamenews.com/" />

{{-- Meta tag google index verification --}}
<meta name="google-site-verification" content="iEChGkx43f5nLfyry5G7KUeSc9ejTJFI-ed8A0it_UU" />

{{-- Meta tags for the page --}}
<title>@yield('title')</title>
<meta name="description" content="Explore the latest and most exciting gaming news at EpicGameNews.com. Stay updated on the hottest releases, industry trends, and in-depth game reviews. Immerse yourself in a world of gaming insights, expert analyses, and exclusive content. Your ultimate destination for everything gaming awaits!">
<meta name="keywords" content="gaming news, video game releases, industry trends, game reviews, esports updates, gaming community, gaming culture, latest game announcements, game analysis, Epic Game News, gaming updates, console news, PC gaming, multiplayer games, gaming events">
<meta name="author" content="Laurențiu Cozma" />
<meta name="theme-color" content="#ffffff">

<!-- Facebook -->
<meta property="og:title" content="Gaming News Now - Epic Game News">
<meta property="og:description" content="Stay updated with the latest gaming news, releases, reviews, and industry trends at Epic Game News. Your ultimate source for everything gaming-related.">
<meta property="og:image" content="{{ asset('storage/logo/logo-epic-game-news-200x200.png') }}">
<meta property="og:url" content="https://epicgamenews.com/">
<meta property="og:site_name" content="Epic Game News">
<meta property="og:type" content="website">
{{-- <meta property="og:profile_id" content=""> --}}
{{-- <meta property="article:author" content=""> --}}

{{-- Font --}}
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900&display=swap">

<!-- Epic Game News Icon Logo -->
<link rel="icon" href="{{ asset('storage/logo/logo-epic-game-news-38x38.png') }}" type="image/x-icon"/>

<!-- Animate.css -->
<link rel="stylesheet" href="{{ asset('blog_template/css/animate.css') }}">
<!-- Icomoon Icon Fonts-->
<link rel="stylesheet" href="{{ asset('blog_template/css/icomoon.css') }}">
<!-- Bootstrap  -->
<link rel="stylesheet" href="{{ asset('blog_template/css/bootstrap.css') }}">    
<!-- Magnific Popup -->
<link rel="stylesheet" href="{{ asset('blog_template/css/magnific-popup.css') }}">
<!-- Flexslider  -->
<link rel="stylesheet" href="{{ asset('blog_template/css/flexslider.css') }}">
<!-- Owl Carousel -->
<link rel="stylesheet" href="{{ asset('blog_template/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('blog_template/css/owl.theme.default.min.css') }}">
<!-- Flaticons  -->
<link rel="stylesheet" href="{{ asset('blog_template/fonts/flaticon/font/flaticon.css') }}">
<!-- Theme style  -->
<link rel="stylesheet" href="{{ asset('blog_template/css/style.css') }}">
{{-- Epic Game News - My Style --}}
<link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">

<!-- Modernizr JS -->
<script src="{{ asset('blog_template/js/modernizr-2.6.2.min.js') }}"></script>
<!-- FOR IE9 below -->
<!--[if lt IE 9]>
<script src="js/respond.min.js"></script>
<![endif]-->

@yield('custom_css')

</head>
<body>	
	
{{-- PAGE --}}
<main id="page">

	{{-- NAVBAR --}}
	<nav class="colorlib-nav" role="navigation">
		<div class="top-menu">
			<div class="container">
				<div class="nav-layout-container">

						<a href="{{ route('home') }}" class="nav-layout-logo-container logo-route">
							<img class="logo-new-game-news img-fluid" src="{{ asset('storage/logo/logo-epic-game-news-38x38.png') }}" alt="logo-new-gaming-news" title="logo-ngn" loading="lazy"> 
							<h1 class="title-route"><b>Epic Game News</b></h1>
						</a>

					<div class="nav-layout-btns-container text-right menu-1">
						
						<ul>
							<a href="{{ route('home') }}"><li class="font-changed">Home</li></a>
							<a href="{{ route('video_games.index') }}"><li class="font-changed">Video Games</li></a>
							<a href="{{ route('categories.index') }}"><li class="font-changed">Categories</li></a>
							<a href="{{ route('platforms.index') }}"><li class="font-changed">Platforms</li></a>
							<a href="{{ route('about') }}"><li class="font-changed">About</li></a>
							<a href="{{ route('contact.create') }}"><li class="font-changed">Contact</li></a>
							<a href="{{ route('others.index') }}"><li class="font-changed">Others</li></a>

							@auth
								<li class="has-dropdown">
									<span class="cursor-pointer font-changed">{{ auth()->user()->name }}<span class="caret"></span></span>
									<ul class="dropdown">										
										<a 
										onclick="event.preventDefault();
										document.getElementById('nav-logout-form').submit()"
										href=""><li class="font-changed-btn first-btn">Logout</li></a>

										<form id="nav-logout-form" action="{{ route('logout') }}" method="POST">
											@csrf
										</form>
									
										@foreach (auth()->user()->roles as $role)
											@if ( $role->name !== "user" )
												<a href="{{ route('admin.index') }}" target="_blank">
													<li class="font-changed-btn">Admin Dasboard</li>
												</a>
											@endif
										@endforeach
									</ul>
								</li>
							@endauth								
						</ul>

					</div>
				</div>
			</div>
		</div>
	</nav>
	{{-- END OF NAVBAR --}}

	{{-- CONTENT OF THE PAGE --}}
	@yield('content')		
	{{-- END OF CONTENT OF THE PAGE --}}

	{{-- SUBSCRIBE NEWSLETTER --}}
	<div id="colorlib-subscribe" class="subs-img" style="background-image: url({{ asset('blog_template/images/img_bg_2.jpg') }});" loading="lazy">
		<div class="overlay"></div>
		<div class="first-container">

			{{-- <div class="container">
				<div >
					<div class="text-center colorlib-heading animate-box">
						<h2>Subscribe Newsletter</h2>
						<p>Subscribe to our newsletter and get the latest update</p>
					</div>
					<div class="animate-box">
						<form id="subscribe-input" class="form-inline">
							<div class="">
								<div class="form-group">
									<input type="text" class="form-control" id="email" placeholder="Enter your email">
								</div>
							</div>
							<div class="">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Subscribe Now</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div> --}}
			
		</div>
	</div>
	{{-- END OF SUBSCRIBE NEWSLETTER --}}
	
</main>
{{-- END OF PAGE --}}

{{-- FOOTER AND COPYRIGHT --}}
<footer id="colorlib-footer">
	{{-- <div class="container">
		<div class="row row-pb-md">
			<div class="col-md-3 colorlib-widget">
				<h4>Contact Info</h4>
				<ul class="colorlib-footer-links">
					<li>291 South 21th Street, <br> Suite 721 New York NY 10016</li>
					<li><a href="tel://1234567920"><i class="icon-phone"></i> + 1235 2355 98</a></li>
					<li><a href="mailto:info@yoursite.com"><i class="icon-envelope"></i> info@yoursite.com</a></li>
					<li><a href="http://luxehotel.com"><i class="icon-location4"></i> yourwebsite.com</a></li>
				</ul>
			</div>
			<div class="col-md-2 colorlib-widget">
				<h4>Programs</h4>
				<p>
					<ul class="colorlib-footer-links">
						<li><a href="#"><i class="icon-check"></i> Diploma Degree</a></li>
						<li><a href="#"><i class="icon-check"></i> BS Degree</a></li>
						<li><a href="#"><i class="icon-check"></i> Beginner</a></li>
						<li><a href="#"><i class="icon-check"></i> Intermediate</a></li>
						<li><a href="#"><i class="icon-check"></i> Advance</a></li>
						<li><a href="#"><i class="icon-check"></i> Difficulty</a></li>
					</ul>
				</p>
			</div>
			<div class="col-md-2 colorlib-widget">
				<h4>Useful Links</h4>
				<p>
					<ul class="colorlib-footer-links">
						<li><a href="#"><i class="icon-check"></i> About Us</a></li>
						<li><a href="#"><i class="icon-check"></i> Testimonials</a></li>
						<li><a href="#"><i class="icon-check"></i> Courses</a></li>
						<li><a href="#"><i class="icon-check"></i> Event</a></li>
						<li><a href="#"><i class="icon-check"></i> News</a></li>
						<li><a href="#"><i class="icon-check"></i> Contact</a></li>
					</ul>
				</p>
			</div>

			<div class="col-md-2 colorlib-widget">
				<h4>Support</h4>
				<p>
					<ul class="colorlib-footer-links">
						<li><a href="#"><i class="icon-check"></i> Documentation</a></li>
						<li><a href="#"><i class="icon-check"></i> Forums</a></li>
						<li><a href="#"><i class="icon-check"></i> Help &amp; Support</a></li>
						<li><a href="#"><i class="icon-check"></i> Scholarship</a></li>
						<li><a href="#"><i class="icon-check"></i> Student Transport</a></li>
						<li><a href="#"><i class="icon-check"></i> Release Status</a></li>
					</ul>
				</p>
			</div>

			<div class="col-md-3 colorlib-widget">
				<h4>Recent Post</h4>
				<div class="f-blog">
					<a href="blog.html" class="blog-img" style="background-image: url({{ asset('blog_template/images/blog-1.jpg') }});">
					</a>
					<div class="desc">
						<h2><a href="blog.html">Creating Mobile Apps</a></h2>
						<p class="admin"><span>18 April 2018</span></p>
					</div>
				</div>
				<div class="f-blog">
					<a href="blog.html" class="blog-img" style="background-image: url({{ asset('blog_template/images/blog-2.jpg') }});">
					</a>
					<div class="desc">
						<h2><a href="blog.html">Creating Mobile Apps</a></h2>
						<p class="admin"><span>18 April 2018</span></p>
					</div>
				</div>
			</div>
		</div>
	</div> --}}
	
	<div class="copy">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<p>
						<small class="block" id="copyrightYear">&copy; Copyright <span id="currentYear"></span> All rights reserved | This website is made by <a href="{{ route('home') }}">Epic Game News</a></small>
						<br> 
					</p>
				</div>
			</div>
		</div>
	</div>
</footer>
{{-- END OF FOOTER AND COPYRIGHT --}}

<div class="gototop js-top">
	<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
</div>

{{-- SCRIPTS --}}
 <!-- jQuery -->
<script src="{{ asset('blog_template/js/jquery.min.js') }}"></script>

{{-- Ajax Lazy Loading --}}
<script src="{{ asset('blog_template/js/ajax-lazy-loading.js') }}"></script>

<!-- jQuery Easing -->
<script src="{{ asset('blog_template/js/jquery.easing.1.3.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('blog_template/js/bootstrap.min.js') }}"></script>
<!-- Waypoints -->
<script src="{{ asset('blog_template/js/jquery.waypoints.min.js') }}"></script>
<!-- Stellar Parallax -->
<script src="{{ asset('blog_template/js/jquery.stellar.min.js') }}"></script>
<!-- Flexslider -->
<script src="{{ asset('blog_template/js/jquery.flexslider-min.js') }}"></script>
<!-- Owl carousel -->
<script src="{{ asset('blog_template/js/owl.carousel.min.js') }}"></script>
<!-- Magnific Popup -->
<script src="{{ asset('blog_template/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('blog_template/js/magnific-popup-options.js') }}"></script>
<!-- Counters -->
<script src="{{ asset('blog_template/js/jquery.countTo.js') }}"></script>
<!-- Main -->
<script src="{{ asset('blog_template/js/main.js') }}"></script>

@yield('custom_js')

<!-- My Scripts -->
<script src="{{ asset('js/functions.js') }}"></script>
{{-- END OF SCRIPTS --}}

<script>
	 $(document).ready(function () {
        
		$('img').lazyload();

	 });
</script>

</body>
</html>