<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

  <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />
 
	<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet">
	
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
		

	<div id="page">
		<nav class="colorlib-nav" role="navigation">
			<div class="top-menu">
				<div class="container">
					<div class="row">
						<div class="col-md-2">
							<div id="colorlib-logo"><a href="{{ route('home') }}">New Gaming News</a></div>
						</div>
						<div class="col-md-10 text-right menu-1">
							<ul>
								<li><a href="{{ route('home') }}">Home</a></li>
								<li class="has-dropdown">
									<a href="{{ route('categories.index') }}">Categories</a>
									<ul class="dropdown">
										@foreach ($navbar_categories as $category)
											<li><a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a></li>
										@endforeach
									</ul>
								</li>
								<li class="has-dropdown">
									<a href="{{ route('platforms.index') }}">Platforms</a>
									<ul class="dropdown">
										@foreach ($navbar_platforms as $platform)											
											<li><a href="{{ route('platforms.show', $platform) }}">{{ $platform->name }}</a></li>
										@endforeach
									</ul>
								</li>
								<li><a href="{{ route('about') }}">About</a></li>
								<li><a href="{{ route('contact.create') }}">Contact</a></li>
								<li class="has-dropdown">
									<a href="{{ route('mores.index') }}">More</a>
									<ul class="dropdown">
										@foreach ($navbar_mores as $more)											
											<li><a href="{{ route('mores.show', $more) }}">{{ $more->name }}</a></li>
										@endforeach
									</ul>
								</li>

								@guest
								<li class="btn-cta"><a href="{{ route('login') }}"><span>Login</span></a></li>
								@endguest

								@auth
								<li class="has-dropdown">
									<a href="#">{{ auth()->user()->name }}<span class="caret"></span></a>
									<ul class="dropdown">
										<li>
											<a 
											onclick="event.preventDefault();
											document.getElementById('nav-logout-form').submit()"
											href="">Logout</a>

											<form id="nav-logout-form" action="{{ route('logout') }}" method="POST">
												@csrf
											</form>

										</li>
									</ul>
								</li>
								@endauth
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>
		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
			   	
			  	</ul>
		  	</div>
		</aside>

        @yield('content')
        
		<div id="colorlib-subscribe" class="subs-img" style="background-image: url({{ asset('blog_template/images/img_bg_2.jpg') }});" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="first-container">
				<div class="container">
					<div >
						<div class="text-center colorlib-heading animate-box">
							<h2>Subscribe Newsletter</h2>
							<p>Subscribe our newsletter and get latest update</p>
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
				</div>				
			</div>
		</div>
		
		<footer id="colorlib-footer">
			<div class="container">
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
			</div>
			<div class="copy">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center">
							<p>
								<small class="block">
									&copy;Copyright &copy;
									<script>document.write(new Date().getFullYear());</script> 
									All rights reserved | This website is made by <a href="{{ route('home') }}">New Gaming News</a>
								</small>
								<br> 
							</p>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="{{ asset('blog_template/js/jquery.min.js') }}"></script>
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

	<script src="{{ asset('js/functions.js') }}"></script>

    @yield('custom_js')

	</body>
</html>