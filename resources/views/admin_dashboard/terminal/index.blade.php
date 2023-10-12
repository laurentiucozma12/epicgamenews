@extends("admin_dashboard.layouts.app")
    
    @section("wrapper")
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.terminal.index') }}">Terminal</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            
            <div class="parent-icon fs-5 mb-3">
                <form method="POST" action="{{ route('admin.terminal.migrate') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <div clas="d-flex">
                            <i class="bx bx-data me-1"></i>RUN php artisan migrate
                        </div>
                    </button>
                </form>
            </div>

            <div class="parent-icon fs-5 mb-3">
                <form method="POST" action="{{ route('admin.terminal.migrateStatus') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary" id="migrateStatusButton">
                        <div clas="d-flex">
                            <i class="bx bx-question-mark me-1"></i>RUN php artisan migrate:status
                        </div>
                    </button>
                </form>
            </div>

        </div>
    </div>
    <!--end page wrapper -->
    @endsection
