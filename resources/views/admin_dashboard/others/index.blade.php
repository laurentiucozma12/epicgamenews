
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.others.index') }}">All Others</a></li>       
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                    <div class="position-relative">
                        <input type="text" class="form-control ps-5 radius-30" placeholder="Search Order"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Related Posts</th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($others as $other)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-2">
                                                <h6 class="mb-0 font-14">{{ $other->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $other->name }}</td>
                                    <td>{{ $other->name }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.others.show', $other) }}">Related Posts</a>    
                                    </td>
                                    <td>{{ $other->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>


    </div>
</div>
<!--end page wrapper -->
@endsection

@section("script")
<script>
    
$(document).ready(function () {

    setTimeout(() => {
        $('.general-message').fadeOut();
    }, 5000);

});

</script>
@endsection