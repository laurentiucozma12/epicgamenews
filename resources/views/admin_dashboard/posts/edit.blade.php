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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.posts.edit', $post) }}"> {{ $post->title }}</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Post: {{ $post->title }}</h5>
                <hr/>

                <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">                                

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Post Title</label>
                                        <input type="text" value='{{ old("title", $post->title) }}' name="title" required class="form-control" id="title">

                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="slug" class="form-label">Post Slug</label>
                                        <input type="text" value='{{ old("slug", $post->slug) }}' name="slug" required class="form-control" id="slug">

                                        @error('slug')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="excerpt" class="form-label">Post Excerpt</label>
                                        <textarea required class="form-control" name='excerpt' id="excerpt" rows="3">{{ old("excerpt", $post->excerpt) }}</textarea>
                                    
                                        @error('excerpt')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Post Video Game</label>                                        
                                        <div class="card shadow-none border">
                                            <div class="card-body">
                                                <div class="rounded">
                                                    <div class="mb-3">
                                                        <select name="video_game_id" required class="single-select">
                                                            @foreach ($video_games as $key => $video_game)
                                                                <option {{ intval($post->video_game_id) === $key ? 'selected' : '' }} value="{{ $key }}">{{ $video_game }}</option>
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
                                        <input type="text" class="form-control" value="{{ $tags }}" name="tags" data-role="tagsinput"  id="tags">

                                        @error('tags')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="com-md-8">
                                                <div class="card shadow-none border">
                                                    <div class="card-body">
                                                        <label for="file" class="form-label">Post Thumbnail (Max 1920)</label>
                                                        <input id='thumbnail' name='thumbnail' id="file" accept="image/*" type="file" class="mb-3">

                                                        @error('thumbnail')
                                                            <p class='text-danger'>{{ $message }}</p>
                                                        @enderror

                                                        {{-- Store the url of the cropped image --}} 
                                                        <input type="hidden" id="croppedImageData" name="croppedImageData" value="">

                                                        <h5>Cropped Image</h5>
                                                        <img id="croppedImage" src="{{ asset($post->image ? 'storage/images/764x431/' . $post->image->name : 'storage/placeholders/thumbnail_placeholder.jpg') }}" class="cropped-thumbnail-edit" alt="Cropped image">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="author_thumbnail" class="form-label">Author of the Thumbnail</label>
                                        <input type="text" value='{{ old("author_thumbnail", $post->author_thumbnail) }}' class="form-control" name="author_thumbnail" id="author_thumbnail">

                                        @error('author_thumbnail')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="body" class="form-label">Post Content</label>
                                        <textarea name="body" class="form-control" id="body" rows="3">
                                            {{ old("body", str_replace('../../', '../../../', $post->body)) }}
                                        </textarea>   
                                    
                                        @error('body')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    @if ( auth()->user()->roles->contains('name', 'admin') )                                    
                                        <div class="form-check form-switch admin-approve-container">
                                            <input name='deleted' {{ intval($post->deleted) === 0 ? 'checked' : '' }} class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label {{ intval($post->deleted) === 0 ? 'text-success' : 'text-danger' }}" for="flexSwitchCheckChecked">
                                                <b>{{ intval($post->deleted) === 0 ? 'Approved' : 'Not approved' }}</b>
                                            </label>
                                        </div>  
                                    @endif
                                    
                                    <div class="d-flex justify-content-between">
                                        <button class='btn btn-primary' type='submit'>Update Post</button>
                                        
                                        <a 
                                        class='btn btn-danger'
                                        onclick="event.preventDefault();document.getElementById('delete_post_{{ $post->id }}').submit()"
                                        href="#">
                                            Delete Post
                                        </a>
                                    </div>
                                
                            </div>                            
                        </div><!--end row-->
                    </div>                        
                </form><!--end form-->
                
                <form id="delete_post_{{ $post->id }}" method="POST" action="{{ route('admin.posts.destroy', $post) }}">
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
