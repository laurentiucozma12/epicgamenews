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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.video_games.edit', $video_game) }}">Edit Video Game {{ $video_game->name }}</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Video Game: {{ $video_game->name }}</h5>
                <hr/>

                <form action="{{ route('admin.video_games.update', $video_game) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">

                                    <div class="mb-3">
                                        <label for="inputSeoDescription" class="form-label">Video Game Seo Description</label>
                                        <textarea type="text" name="seo_description" required class="form-control" id="inputSeoDescription" rows="2">{{ old("seo_description", $seo->description ) }}</textarea>

                                        @error('seo_description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputSeoKeywords" class="form-label">Video Game Seo Keywords</label>
                                        <input type="text" value='{{ old("seo_keywords", $seo->keywords) }}' name="seo_keywords" required class="form-control" id="inputSeoKeywords">

                                        @error('seo_keywords')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Video Game Name</label>
                                        <input type="text" value='{{ old("name", $video_game->name) }}' name="name" required class="form-control" id="inputProductTitle">

                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Video Game Slug</label>
                                        <input type="text" value='{{ old("slug", $video_game->slug) }}' name="slug" required class="form-control" id="inputProductTitle">

                                        @error('slug')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Post Category</label>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="rounded">
                                                    <div class="mb-3">
                                                        <select id="categories_ids" name="categories_ids[]" multiple="multiple" class="multiple-select" data-placeholder="Choose categories" required>
                                                            @foreach ($categories as $key => $category)
                                                                <option value="{{ $key }}" {{ in_array($key, $selectedCategFormIds) ? 'selected' : '' }}>{{ $category }}</option>
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
                                        <label class="form-label">Post Platform</label>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="rounded">
                                                    <div class="mb-3">
                                                        <select id="platforms_ids" name="platforms_ids[]" multiple="multiple" class="multiple-select" data-placeholder="Choose platforms" required>
                                                            @foreach ($platforms as $key => $platform)
                                                                <option value="{{ $key }}" {{ in_array($key, $selectedPlatFormIds) ? 'selected' : '' }}>{{ $platform }}</option>
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
                                        <div class="row">
                                            <div class="com-md-8">
                                                <div class="card shadow-none border">
                                                    <div class="card-body">
                                                        <label for="file" class="form-label">Video Game Thumbnail (Max 1920)</label>
                                                        <input id='thumbnail' name='thumbnail' id="file" accept="image/*" type="file" class="mb-3">

                                                        @error('thumbnail')
                                                            <p class='text-danger'>{{ $message }}</p>
                                                        @enderror

                                                        {{-- Store the url of the cropped image --}} 
                                                        <input type="hidden" id="croppedImageData" name="croppedImageData" value="">

                                                        <h5>Cropped Image</h5>
                                                        <img id="croppedImage" src="{{ asset($video_game->image ? 'storage/images/400x225/' . $video_game->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}" class="cropped-thumbnail-edit" alt="Cropped image">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <button class='btn btn-primary' type='submit'>Update Video Game</button>

                                        <a 
                                        class='btn btn-danger'
                                        onclick="event.preventDefault();document.getElementById('delete_video_game_{{ $video_game->id }}').submit()"
                                        href="#">
                                            Delete Video Game
                                        </a>
                                    </div>

                            </div>                            
                        </div><!--end row-->
                    </div>                        
                </form><!--end form-->
                
                <form id="delete_video_game_{{ $video_game->id }}" method="POST" action="{{ route('admin.video_games.destroy', $video_game) }}">
                    @csrf
                    @method('DELETE')
                </form>

            </div>
        </div>
    </div>
</div>

{{-- Crop Modal --}}
<x-crop-modal />

@section("script")
<script>
$(document).ready(function(){
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