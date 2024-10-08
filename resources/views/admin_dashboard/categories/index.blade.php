
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.categories.index') }}">All Categories</a></li>       
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                    <div class="position-relative d-flex align-items-center">
                        <form action="{{ route('admin.categories.search') }}" method="GET">
                            @csrf
                            
                            <input type="search" name="search" value="{{ isset($search) ? $search : '' }}" class="form-control ps-5 radius-30" placeholder="Search Category"><span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                        </form>
                        <span class="count count-total ms-2">Total: {{ count($categories) }}</span>
                        <span class="count count-active ms-2">Active: {{ count($categories->where('deleted', 0)) }}</span>
                        <span class="count count-inactive ms-2">Inactive: {{ count($categories->where('deleted', '!=', 0)) }}</span> 
                    </div>
                    <div class="ms-auto"><a href="{{ route('admin.categories.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New Category</a></div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Id</th>
                                <th>Status</th>
                                <th>Thumbnail</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Related Games</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Created By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-2">
                                                <h6 class="mb-0 font-14">{{ $category->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if(intval($category->deleted) === 0)
                                            <div class="text-info bg-light-info badge rounded-pill p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Active</div>
                                        @else
                                            <div class="text-danger bg-light-danger badge rounded-pill p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Inactive</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($category->image && $category->image->name !== "thumbnail_placeholder.jpg")
                                            <img src="{{ asset('storage/images/300x169/' . $category->image->name) }}" width='50' alt="{{ $category->image->name }}">
                                        @else
                                            <img src="{{ asset('storage/placeholders/thumbnail_placeholder.jpg') }}" width='50' alt="Placeholder">
                                        @endif
                                    </td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.categories.show', $category) }}">{{ count($category->videoGames) }} Related Video Games</a>
                                    </td>
                                    <td>{{ $category->created_at->diffForHumans() }}</td>
                                    <td>{{ $category->updated_at->diffForHumans() }}</td>
                                    <td>{{ $category->user->name }}</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{ route('admin.categories.edit', $category) }}" ><i class='bx bxs-edit'></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class='mt-4'>
                    {{ $categories->onEachSide(0)->links('pagination::bootstrap-4') }}
                </div>

            </div>
        </div>


    </div>
</div>
<!--end page wrapper -->
@endsection