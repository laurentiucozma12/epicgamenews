
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.platforms.index') }}">All Platforms</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.platforms.edit', $platform) }}">Edit Platform {{ $platform->name }}</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Platform: {{ $platform->name }}</h5>
                <form action="{{ route('admin.platforms.update', $platform) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="seo_title" class="form-label">Platform Seo Title</label>
                                    <input type="text" name="seo_title"  value='{{ old("seo_title", $seo->seo_title) }}' id="seo_title" class="form-control" required>

                                    @error('seo_title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="seo_description" class="form-label">Platform Seo Description</label>
                                    <textarea type="text" name="seo_description" required class="form-control" id="seo_description" rows="2">{{ old("seo_description", $seo->seo_description ) }}</textarea>

                                    @error('seo_description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="seo_keywords" class="form-label">Platform Seo Keywords</label>
                                    <input type="text" value='{{ old("seo_keywords", $seo->seo_keywords) }}' name="seo_keywords" required class="form-control" id="seo_keywords">

                                    @error('seo_keywords')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>                            
                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <div class="card-body">
                                        <label for="file" class="form-label">Platform Thumbnail (Max 1920)</label>
                                        <input id='thumbnail' name='thumbnail' id="file" accept="image/*" type="file" class="mb-3">

                                        @error('thumbnail')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror

                                        {{-- Store the url of the cropped image --}} 
                                        <input type="hidden" id="croppedImageData" name="croppedImageData" value="">

                                        <h5>Cropped Image</h5>
                                        <img id="croppedImage" src="{{ asset($platform->image ? 'storage/images/400x225/' . $platform->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}" class="cropped-thumbnail-edit" alt="Cropped image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Platform Name</label>
                                    <input type="text" value='{{ old("name", $platform->name) }}' name="name" required class="form-control" id="inputProductTitle">

                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Platform Slug</label>
                                    <input type="text" value='{{ old("slug", $platform->slug) }}' name="slug" required class="form-control" id="inputProductTitle">

                                    @error('slug')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                @if ( auth()->user()->roles->contains('name', 'admin') )                                    
                                    <div class="form-check form-switch admin-approve-container">
                                        <input name='deleted' {{ intval($platform->deleted) === 0 ? 'checked' : '' }} class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                        <label class="form-check-label {{ intval($platform->deleted) === 0 ? 'text-success' : 'text-danger' }}" for="flexSwitchCheckChecked">
                                            <b>{{ intval($platform->deleted) === 0 ? 'Approved' : 'Not approved' }}</b>
                                        </label>
                                    </div>  
                                @endif
                                
                                <div class="d-flex justify-content-between">
                                    <button class='btn btn-primary' type='submit'>Update Platform</button>

                                    <a 
                                    class='btn btn-danger'
                                    onclick="event.preventDefault();document.getElementById('delete_platform_{{ $platform->id }}').submit()"
                                    href="#">
                                        Delete Platform
                                    </a>
                                </div>

                            </div>                            
                        </div><!--end row-->
                    </div>                        
                </form><!--end form-->
                
                <form id="delete_platform_{{ $platform->id }}" method="POST" action="{{ route('admin.platforms.destroy', $platform) }}">
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