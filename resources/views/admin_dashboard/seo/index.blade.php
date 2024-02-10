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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.seo.index') }}">All Pages</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Id</th>
                                <th>Page</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Keywords</th>
                                <th>Created At</th>
                                <th>Created By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($seos as $seo)
                                <tr>
                                    <td>{{ $seo->id }}</td>
                                    <td>{{ $seo->page_name }}</td>
                                    <td>{{ Str::limit($seo->title, 35) }}</td>
                                    <td>{{ Str::limit($seo->description, 30) }}</td>
                                    <td>{{ Str::limit($seo->keywords, 25) }}</td>
                                    <td>{{ $seo->created_at->diffForHumans() }}</td>
                                    <td>{{ $seo->author->name }}</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{ route('admin.seo.edit', $seo) }}" class=""><i class='bx bxs-edit'></i></a> 
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