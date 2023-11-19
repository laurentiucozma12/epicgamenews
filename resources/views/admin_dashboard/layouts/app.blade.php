<!doctype html>
<html lang="en">

<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Epic Game News Icon Logo -->
<link href="{{ asset('storage/logo/logo-epic-game-news-38x38.png') }}" rel="icon" type="image/x-icon"/>

<!--plugins-->
@yield("style")
<link href="{{ asset('admin_dashboard_assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
<link href="{{ asset('admin_dashboard_assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
<link href="{{ asset('admin_dashboard_assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin_dashboard_assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin_dashboard_assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
<link href="{{ asset('admin_dashboard_assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />

<!-- loader-->
<link href="{{ asset('admin_dashboard_assets/css/pace.min.css') }}" rel="stylesheet" />
<script src=" {{ asset('admin_dashboard_assets/js/pace.min.js') }}"></script>

<!-- Bootstrap CSS -->
<link href="{{ asset('admin_dashboard_assets/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<link href="{{ asset('admin_dashboard_assets/css/app.css') }}" rel="stylesheet">
<link href=" {{ asset('admin_dashboard_assets/css/icons.css') }}" rel="stylesheet">

<!-- Theme Style CSS -->
<link href="{{ asset('admin_dashboard_assets/css/dark-theme.css') }}" rel="stylesheet" />
<link href="{{ asset('admin_dashboard_assets/css/semi-dark.css') }}" rel="stylesheet" />
<link href="{{ asset('admin_dashboard_assets/css/header-colors.css') }}" rel="stylesheet" />

{{-- Tiny MCE --}}
<script src="https://cdn.tiny.cloud/1/nhtc4hkvw9rxs4ivm25pg3brruxcsjsaknsuggv71arm406g/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

{{-- Crop --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">

{{-- My Style --}}    
<link href="{{ asset('admin_dashboard_assets/css/app.css') }}" rel="stylesheet">
<link href="{{ asset('admin_dashboard_assets/css/my_style.css') }}" rel="stylesheet" />
<link href="{{ asset('css/mystyle.css') }}" rel="stylesheet" />

<title>Admin Dashboard - New Game News </title>
</head>

<body>

{{-- Alert Messages --}}
<x-blog.message/>

<!--wrapper-->
<div class="wrapper">
    <!--start header -->
    @include("admin_dashboard.layouts.header")
    <!--end header -->
    <!--navigation-->
    @include("admin_dashboard.layouts.nav")
    <!--end navigation-->
    <!--start page wrapper -->
    @yield("wrapper")
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    <footer class="page-footer">
        <p class="mb-0">Copyright © 2023. All right reserved.</p>
    </footer>
</div>
<!--end wrapper-->
<!--start switcher-->
<div class="switcher-wrapper">
    <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
    </div>
    <div class="switcher-body">
        <div class="d-flex align-items-center">
            <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
            <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
        </div>
        <hr/>
        <h6 class="mb-0">Theme Styles</h6>
        <hr/>
        <div class="d-flex align-items-center justify-content-between">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
                <label class="form-check-label" for="lightmode">Light</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
                <label class="form-check-label" for="darkmode">Dark</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
                <label class="form-check-label" for="semidark">Semi Dark</label>
            </div>
        </div>
        <hr/>
        <div class="form-check">
            <input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
            <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
        </div>
        <hr/>
        <h6 class="mb-0">Header Colors</h6>
        <hr/>
        <div class="header-colors-indigators">
            <div class="row row-cols-auto g-3">
                <div class="col">
                    <div class="indigator headercolor1" id="headercolor1"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor2" id="headercolor2"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor3" id="headercolor3"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor4" id="headercolor4"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor5" id="headercolor5"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor6" id="headercolor6"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor7" id="headercolor7"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor8" id="headercolor8"></div>
                </div>
            </div>
        </div>
        <hr/>
        <h6 class="mb-0">Sidebar Colors</h6>
        <hr/>
        <div class="header-colors-indigators">
            <div class="row row-cols-auto g-3">
                <div class="col">
                    <div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="{{ asset('admin_dashboard_assets/js/bootstrap.bundle.min.js') }}"></script>

<!--jQuery-->
<script src="{{ asset('admin_dashboard_assets/js/jquery.min.js') }}"></script>

{{-- Ajax Lazy Loading --}}
<script src="{{ asset('blog_template/js/ajax-lazy-loading.js') }}"></script>

{{-- Crop --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

{{-- plugins --}}
<script src="{{ asset('admin_dashboard_assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('admin_dashboard_assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('admin_dashboard_assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('admin_dashboard_assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('admin_dashboard_assets/plugins/input-tags/js/tagsinput.js') }}"></script>

<!--app JS-->
<script src="{{ asset('admin_dashboard_assets/js/app.js') }}"></script>

{{-- Custom Scripts --}}
<script src="{{ asset('admin_dashboard_assets/js/functions.js') }}"></script>

@yield("script")
</body>

</html>
