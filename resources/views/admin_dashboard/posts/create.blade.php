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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.posts.index') }}">All Posts</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.posts.create') }}">Add New Posts</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add New Post</h5>
                <hr/>

                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="mb-3">
                                    <label for="title" class="form-label">Post Title</label>
                                    <input type="text" value='{{ old("title") }}' name="title" required class="form-control" id="title">

                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="slug" class="form-label">Post Slug</label>
                                    <input type="text" value='{{ old("slug") }}' name="slug" required class="form-control" id="slug">

                                    @error('slug')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="excerpt" class="form-label">Post Excerpt</label>
                                    <textarea class="form-control" required name='excerpt' id="excerpt" rows="3">{{ old("excerpt") }}</textarea>
                                
                                    @error('excerpt')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Post Video Game</label>                                        
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="rounded">
                                                <div class="mb-3">
                                                    <select name="video_game_id" required class="single-select">
                                                        @foreach ($video_games as $video_game)
                                                            <option value="{{ intval($video_game->id) }}">{{ $video_game->name }}</option>                                                                
                                                        @endforeach
                                                    </select>

                                                    @error('video_game_id')
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
                                    <label for="tags" class="form-label">Post Tags</label>
                                    <input type="text" value="{{ old("tags") }}" class="form-control" name="tags" id="tags" data-role="tagsinput" required>

                                    @error('tags')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
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
                                            <img id="croppedImage" src="#" alt="Cropped image" class="cropped-thumbnail">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="author_thumbnail" class="form-label">Author of the Thumbnail</label>
                                    <input type="text" value="{{ old("author_thumbnail") }}" class="form-control" name="author_thumbnail" id="author_thumbnail">

                                    @error('author_thumbnail')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="body" class="form-label">Post Content</label>
                                    <textarea id="body" name="body" class="form-control" rows="3">{{ old("body") }}</textarea>   
                                
                                    @error('body')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <button class='btn btn-primary' type='submit'>Add Post</button>

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

<!--end page wrapper -->
@endsection

@section("script")
@endsection