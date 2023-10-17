
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

                <form action="{{ route('admin.others.update', $other) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">

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
                                                <div class="card shadow-none border">
                                                    <div class="card-body">
                                                        <label for="file" class="form-label">Other Thumbnail (Max 1920)</label>
                                                        <input id='thumbnail' name='thumbnail' id="file" accept="image/*" type="file" class="mb-3">

                                                        @error('thumbnail')
                                                            <p class='text-danger'>{{ $message }}</p>
                                                        @enderror

                                                        {{-- Store the url of the cropped image --}} 
                                                        <input type="hidden" id="croppedImageData" name="croppedImageData" value="">

                                                        <h5>Cropped Image</h5>
                                                        <img id="croppedImage" src="/storage/{{ $other->image ? $other->image->path : 'placeholders/thumbnail_placeholder.jpg' }}" class="cropped-thumbnail-edit" alt="Cropped image">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between">
                                        <button class='btn btn-primary' type='submit'>Update Other</button>

                                        <a 
                                        class='btn btn-danger'
                                        onclick="event.preventDefault();document.getElementById('delete_other_{{ $other->id }}').submit()"
                                        href="#">
                                            Delete Other
                                        </a>
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

{{-- Crop Modal --}}
<x-crop-modal />

<!--end page wrapper -->
@endsection