@extends("admin_dashboard/layouts.app")
@section("style")
    <link href="{{ asset('admin_dashboard_assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
@endsection

@section("wrapper")
    <div class="page-wrapper">
        <div class="page-content">
            Home page    
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('admin_dashboard_assets/js/index.js') }}"></script>
@endsection
