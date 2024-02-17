
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.platforms.index') }}">All Platforms</a></li>       
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                    <div class="position-relative">
                        <form action="{{ route('admin.platforms.search') }}" method="GET">
                            @csrf

                            <input type="search" name="search" value="{{ isset($search) ? $search : '' }}" class="form-control ps-5 radius-30" placeholder="Search Platform"><span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                        </form>
                    </div>
                    <div class="ms-auto"><a href="{{ route('admin.platforms.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New Platform</a></div>
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
                                <th>Related Video Games</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Created By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($platforms as $platform)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-2">
                                                <h6 class="mb-0 font-14">{{ $platform->id }}</h6>
                                            </div>
                                        </div>
                                    </td>                                    
                                    <td>
                                        @if(intval($platform->deleted) === 0)
                                            <div class="text-info bg-light-info badge rounded-pill p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Active</div>
                                        @else
                                            <div class="text-danger bg-light-danger badge rounded-pill p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Inactive</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($platform->image && $platform->image->name !== "thumbnail_placeholder.jpg")
                                            <img src="{{ asset('storage/images/300x169/' . $platform->image->name) }}" width='50' alt="{{ $platform->image->name }}">
                                        @else
                                            <img src="{{ asset('storage/placeholders/thumbnail_placeholder.jpg') }}" width='50' alt="Placeholder">
                                        @endif
                                    </td>
                                    <td>{{ $platform->name }}</td>
                                    <td>{{ $platform->slug }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.platforms.show', $platform) }}">{{ count($platform->videoGames) }} Related Video Games</a>
                                    </td>
                                    <td>{{ $platform->created_at->diffForHumans() }}</td>
                                    <td>{{ $platform->updated_at->diffForHumans() }}</td>
                                    <td>{{ $platform->user->name }}</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{ route('admin.platforms.edit', $platform) }}" ><i class='bx bxs-edit'></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class='mt-4'>
                    {{ $platforms->onEachSide(0)->links('pagination::bootstrap-4') }}
                </div>

            </div>
        </div>

    </div>
</div>
<!--end page wrapper -->
@endsection