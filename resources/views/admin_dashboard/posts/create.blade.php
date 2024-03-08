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
            <div class="card-body">
                <h5 class="card-title">Add New Post</h5>

                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">

                                <div class="mb-3">
                                    <label class="form-label">Post Video Game</label>                                        
                                    <div>
                                        <div>
                                            <div class="rounded">
                                                <div class="mb-3">
                                                    <select name="video_game_id" class="single-select">
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
                                    <label for="author_thumbnail" class="form-label">Author of the Thumbnail</label>
                                    <input type="text" value="{{ old("author_thumbnail") }}" class="form-control" name="author_thumbnail" id="author_thumbnail">

                                    @error('author_thumbnail')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tags" class="form-label">Post Tags / SEO Keywords</label>
                                    <input type="text" value="{{ old("tags") }}" class="form-control" name="tags" id="tags" data-role="tagsinput">

                                    @error('tags')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>                                
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Post Thumbnail (Max 1920)</label>                                    
                                    <input id="thumbnail" name="thumbnail" type="file" accept="image/*" class="mb-3">

                                    @error('thumbnail')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror

                                    {{-- Store the url of the cropped image --}} 
                                    <input type="hidden" id="croppedImageData" name="croppedImageData" value="">

                                    <h5>Cropped Image</h5>
                                    <img id="croppedImage" src="#" alt="Cropped image" class="cropped-thumbnail" widht="342">                                       
                                </div>    
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-12">                            
                                
                                

                                <div class="mb-3">
                                    <label for="title" class="form-label">Post Title</label>
                                    <input type="text" value='{{ old("title") }}' name="title" class="form-control" id="title">

                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="slug" class="form-label">Post Slug <span class="text-danger">REQUIRED</span></label>
                                    <input type="text" value='{{ old("slug") }}' name="slug" required class="form-control" id="slug">

                                    @error('slug')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="excerpt" class="form-label">Post Excerpt</label>
                                    <textarea class="form-control" name='excerpt' id="excerpt" rows="2" minlength="5" maxlength="300">{{ old("excerpt") }}</textarea>
                                
                                    @error('excerpt')
                                        <p class='text-danger'>{{ $message }}</p>
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

<script>
    images_upload_handler = (blobInfo, progress) =>
        new Promise((resolve, reject) => {
            const formData = new FormData();
            let _token = $("input[name='token']").val();

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "{{ route('admin.upload_tinymce_image') }}");

            xhr.onload = () => {
                if (xhr.status === 403) {
                    reject({
                        message: "HTTP Error: " + xhr.status,
                        remove: true,
                    });
                    return;
                }

                if (xhr.status < 200 || xhr.status >= 300) {
                    reject("HTTP Error: " + xhr.status);
                    return;
                }

                const json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != "string") {
                    reject("Invalid JSON: " + xhr.responseText);
                    return;
                }

                resolve(json.location);
            };

            formData.append("_token", "{{ csrf_token() }}");
            formData.append("file", blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        });

    tinymce.init({
        selector: "#body, #description",
        plugins:
            "advlist  anchor autolink autosave charmap codesample directionality emoticons help image insertdatetime link linkchecker lists media nonbreaking pagebreak searchreplace table visualblocks visualchars wordcount",
        toolbar:
            "undo redo spellcheckdialog  | blocks fontfamily fontsizeinput | bold italic underline forecolor backcolor | link image | align lineheight checklist bullist numlist | indent outdent | removeformat typography",
        height: "700px",

        //HTML custom font options
        font_size_formats:
            "8pt 9pt 10pt 11pt 12pt 14pt 18pt 24pt 30pt 36pt 48pt 60pt 72pt 96pt",

        toolbar_sticky: true,
        autosave_restore_when_empty: true,
        spellchecker_active: true,
        spellchecker_language: "en_US",
        spellchecker_languages:
            "English (United States)=en_US,English (United Kingdom)=en_GB,Danish=da,French=fr,German=de,Italian=it,Polish=pl,Spanish=es,Swedish=sv",
        typography_langs: ["en-US"],
        typography_default_lang: "en-US",

        image_title: true,
        automatic_uploads: true,

        images_upload_handler: images_upload_handler,
    });
</script>
<!--end page wrapper -->
@endsection