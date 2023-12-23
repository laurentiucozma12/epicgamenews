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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.video_games.index') }}">All Video Games</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.video_games.create') }}">Add New Video Game</a></li>    
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add New Video Game</h5>
                <hr/>

                <form action="{{ route('admin.video_games.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Video Game Name</label>
                                    <input type="text" value='{{ old("name") }}' name="name" required class="form-control" id="inputProductTitle">

                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Video Game Slug</label>
                                    <input type="text" value='{{ old("slug") }}' name="slug" required class="form-control" id="inputProductTitle">

                                    @error('slug')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Video Game Category</label>                                        
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="rounded">
                                                <div class="mb-3">
                                                    <select id="categories_ids" name="categories_ids[]" multiple="multiple" class="multiple-select" data-placeholder="Choose categories" required>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}" {{ $category->name === 'uncategorized' ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @error('categories_ids')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror

                                                    @if($errors->has('all_fields'))
                                                        <p class="text-danger">{{ $errors->first('all_fields') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Video Game Platform</label>                                        
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="rounded">
                                                <div class="mb-3">
                                                    <select id="platforms_ids" name="platforms_ids[]" multiple="multiple" class="multiple-select" data-placeholder="Choose platforms" required>
                                                        @foreach ($platforms as $platform)
                                                            <option value="{{ $platform->id }}" {{ $platform->name === 'uncategorized' ? 'selected' : '' }}>
                                                                {{ $platform->name }}
                                                            </option>     
                                                        @endforeach
                                                    </select>

                                                    @error('platforms_ids')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror

                                                    @if($errors->has('all_fields'))
                                                        <p class="text-danger">{{ $errors->first('all_fields') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Post Thumbnail (Max 1920)</label>
                                    <div class="card">
                                        <div class="card-body">
                                            <input id="thumbnail" name="thumbnail" type="file" accept="image/*" class="mb-3">

                                            @error('thumbnail')
                                                <p class='text-danger'>{{ $message }}</p>
                                            @enderror

                                            {{-- Store the url of the cropped image --}} 
                                            <input type="hidden" id="croppedImageData" name="croppedImageData" value="">

                                            <h5>Cropped Image</h5>
                                            <img id="croppedImage" class="cropped-thumbnail" src="#" alt="Cropped image">
                                        </div>
                                    </div>
                                </div>

                                <button class='btn btn-primary' type='submit'>Add Video Game</button>

                            </div>                            
                        </div><!--end row-->
                    </div>                        
                </form><!--end form-->
            </div>
        </div>
    </div>
</div>

{{-- Crop Modal --}}
<x-crop-modal />

@section("script")
<script>
$(document).ready(function() {
    ////// Select //////
    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
    $('.multiple-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
    ////// End of Select //////
});
</script>
@endsection