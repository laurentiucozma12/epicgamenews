
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.others.index') }}">All Others</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.others.edit', $other) }}">Edit Other {{ $other->name }}</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->   
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Other: {{ $other->name }}</h5>
                <hr/>

                <form action="{{ route('admin.others.update', $other) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="border border-3 p-4 rounded">

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Other Name</label>
                                        <input type="text" value='{{ old("name", $other->name) }}' name="name" required class="form-control" id="inputProductTitle">

                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Other Slug</label>
                                        <input type="text" value='{{ old("slug", $other->slug) }}' name="slug" required class="form-control" id="inputProductTitle">

                                        @error('slug')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="com-md-8">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <label for="file" class="form-label">Other Thumbnail (Max 1920 x 1080)</label>
                                                        <input id='thumbnail' name='thumbnail' id="file" type="file">

                                                        @error('thumbnail')
                                                            <p class='text-danger'>{{ $message }}</p>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="com-md-4">
                                                <img style="width: 540px" src="/storage/{{ $other->image ? $other->image->path : 'placeholders/thumbnail_placeholder.jpg' }}" class="img-responsive" alt="Post Thumbnail">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="update-delete-btn-container">
                                        <button class='btn btn-primary' type='submit'>Update Other</button>

                                        <a 
                                        class='btn btn-danger'
                                        onclick="event.preventDefault();document.getElementById('delete_other_{{ $other->id }}').submit()"
                                        href="#">
                                            Delete Other
                                        </a>
                                    </div>

                                </div>
                            </div>                            
                        </div><!--end row-->
                    </div>                        
                </form><!--end form-->
                
                <form id="delete_other_{{ $other->id }}" method="POST" action="{{ route('admin.others.destroy', $other) }}">
                    @csrf
                    @method('DELETE')
                </form>

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