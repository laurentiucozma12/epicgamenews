@extends("admin_dashboard.layouts.app")

@section("style")

<link href="{{ asset('admin_dashboard_assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin_dashboard_assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

<link href="{{ asset('admin_dashboard_assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />

<script src="https://cdn.tiny.cloud/1/nhtc4hkvw9rxs4ivm25pg3brruxcsjsaknsuggv71arm406g/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection
    
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
                                <div class="border border-3 p-4 rounded">

                                    <div class="mb-3">
                                        <label for="inputPostTitle" class="form-label">Post Title</label>
                                        <input type="text" value='{{ old("title") }}' name="title" required class="form-control" id="inputPostTitle">

                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputPostSlug" class="form-label">Post Slug</label>
                                        <input type="text" value='{{ old("slug") }}' name="slug" required class="form-control" id="inputPostSlug">

                                        @error('slug')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputPostExcerpt" class="form-label">Post Excerpt</label>
                                        <textarea class="form-control" required name='excerpt' id="inputPostExcerpt" rows="3">{{ old("excerpt") }}</textarea>
                                    
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
                                                                <option value="{{ $video_game->id }}">{{ $video_game->name }}</option>                                                                
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
                                        <label class="form-label">Post Category</label>                                        
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="rounded">
                                                    <div class="mb-3">
                                                        <select id="categories" name="categories[]" multiple="multiple" class="multiple-select" data-placeholder="Choose platforms" required>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}" {{ $category->name === 'uncategorized' ? 'selected' : '' }}>
                                                                    {{ $category->name }}
                                                                </option>     
                                                            @endforeach
                                                        </select>

                                                        @error('categories')
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
                                                        
                                                        <select id="platforms" name="platforms[]" multiple="multiple" class="multiple-select" data-placeholder="Choose platforms" required>
                                                            <option value="1" selected>uncategorized</option>
                                                            <option value="2">PC Games</option>
                                                            <option value="3">PlayStation</option>
                                                            <option value="4">Xbox</option>
                                                            <option value="5">Mobile</option>
                                                            <option value="6">Nintendo</option>
                                                        </select>

                                                        @error('platforms')
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
                                        <label class="form-label">Post Other</label>                                        
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="rounded">
                                                    <div class="mb-3">
                                                        <select name="other_id" required class="single-select">
                                                            <option value="1" selected>uncategorized</option>
                                                            <option value="2">Game Trailers</option>
                                                            <option value="3">Anime</option>
                                                            <option value="4">Cartoons</option>
                                                            <option value="5">Movies</option>
                                                            <option value="6">Series</option>
                                                            <option value="7">Lists</option>
                                                        </select>

                                                        @error('other_id')
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
                                        <label for="inputPostTags" class="form-label">Post Tags</label>
                                        <input type="text" value="{{ old("tags") }}" class="form-control" name="tags" id="inputPostTags" data-role="tagsinput" required>

                                        @error('tags')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <label for="file" class="form-label">Post Thumbnail (Max 1800 x 900)</label>
                                                <input id='thumbnail' required name='thumbnail' id="file" type="file">

                                                @error('thumbnail')
                                                    <p class='text-danger'>{{ $message }}</p>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputAuthorThumbnail" class="form-label">Author of the Thumbnail</label>
                                        <input type="text" value="{{ old("author_thumbnail") }}" class="form-control" name="author_thumbnail" id="inputAuthorThumbnail">

                                        @error('author_thumbnail')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputPostContent" class="form-label">Post Content</label>
                                        <textarea id="inputPostContent" name="body" class="form-control" rows="3">{{ old("body") }}</textarea>   
                                    
                                        @error('body')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <button class='btn btn-primary' type='submit'>Add Post</button>

                                </div>
                            </div>                            
                        </div><!--end row-->
                    </div>                        
                </form><!--end form-->
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->
@endsection

@section("script")

<script src="{{ asset('admin_dashboard_assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('admin_dashboard_assets/plugins/input-tags/js/tagsinput.js') }}"></script>

<script>
$(document).ready(function () {

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

    // Tiny MCE
    images_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {  
        const formData = new FormData();
        let _token = $("input[name='token']").val();

        const xhr = new XMLHttpRequest();
        xhr.open('POST', "{{ route('admin.upload_tinymce_image') }}");

        xhr.onload = () => {
            if (xhr.status === 403) {
                reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
                return;
            }

            if (xhr.status < 200 || xhr.status >= 300) {
                reject('HTTP Error: ' + xhr.status);
                return;
            }

            const json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
                reject('Invalid JSON: ' + xhr.responseText);
                return;
            }

            resolve(json.location);
        };

        formData.append('_token', '{{ csrf_token() }}');
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        xhr.send(formData);
    });
    
    tinymce.init({
        selector: 'textarea#inputPostContent',
        plugins: 'advlist autolink lists link image media charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
        height: '500',

        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code | rtl ltr',
        toolbar_mode: 'floating',

        image_title: true,
        automatic_uploads: true,

        images_upload_handler: images_upload_handler,
    });

    setTimeout(() => {
        $('.general-message').fadeOut();
    }, 5000);

});

</script>
@endsection