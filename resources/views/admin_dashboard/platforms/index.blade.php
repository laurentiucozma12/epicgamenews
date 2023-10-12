
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
                        <input type="text" class="form-control ps-5 radius-30" placeholder="Search Order"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                    </div>
                    <div class="ms-auto"><a href="{{ route('admin.platforms.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New Platform</a></div>
                </div>                    
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Id</th>
                                <th>Thumbnail</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Related Posts</th>
                                <th>Created at</th>
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
                                        <img width='50' src="{{ $platform->image ? asset('storage/' . $platform->image->path) : asset('storage/placeholders/thumbnail_placeholder.jpg') }}" alt="post thumbnail">    
                                    </td>
                                    <td>{{ $platform->name }}</td>
                                    <td>{{ $platform->slug }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.platforms.show', $platform) }}">Related Posts</a>    
                                    </td>
                                    <td>{{ $platform->created_at->diffForHumans() }}</td>
                                    <td>{{ $platform->user->name }}</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{ route('admin.platforms.edit', $platform) }}" ><i class='bx bxs-edit'></i></a>
                                            <a href="#" onclick="event.preventDefault(); document.getElementById('delete_form_{{ $platform->id }}').submit()" class="ms-3"><i class='bx bxs-trash'></i></a>
                                        
                                            <form method="POST" action="{{ route('admin.platforms.destroy', $platform) }}" id="delete_form_{{ $platform->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
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