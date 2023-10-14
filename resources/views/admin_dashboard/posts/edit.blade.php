@extends("admin_dashboard.layouts.app")

@section("style")

<link href="{{ asset('admin_dashboard_assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin_dashboard_assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

<link href="{{ asset('admin_dashboard_assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />

{{-- Tiny MCE --}}
<script src="https://cdn.tiny.cloud/1/nhtc4hkvw9rxs4ivm25pg3brruxcsjsaknsuggv71arm406g/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

{{-- Crop --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">

{{-- My Admin Style --}}
<link href="{{ asset('admin_dashboard_assets/css/my_style.css') }}" rel="stylesheet" />@endsection
    
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
                                        <label for="inputPostTitle" class="form-label">Post Title</label>
                                        <input type="text" value='{{ old("title", $post->title) }}' name="title" required class="form-control" id="inputPostTitle">

                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputPostSlug" class="form-label">Post Slug</label>
                                        <input type="text" value='{{ old("slug", $post->slug) }}' name="slug" required class="form-control" id="inputPostSlug">

                                        @error('slug')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputPostExcerpt" class="form-label">Post Excerpt</label>
                                        <textarea required class="form-control" name='excerpt' id="inputPostExcerpt" rows="3">{{ old("excerpt", $post->excerpt) }}</textarea>
                                    
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
                                                                <option {{ $post->video_game_id === $key ? 'selected' : '' }} value="{{ $key }}">{{ old("video_game_id", $post->$video_game) }}</option>                                                      
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
                                        <div class="card shadow-none border">
                                            <div class="card-body">
                                                <div class="rounded">
                                                    <div class="mb-3">
                                                        <select id="categories" name="categories[]" multiple="multiple" class="multiple-select" data-placeholder="Choose categories" required>
                                                            @foreach ($categories as $key => $category)
                                                                <option value="{{ $key }}" {{ in_array($key, $selectedCategformIds) ? 'selected' : '' }}>{{ old("categories", $post->categories) }}</option>
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
                                        <div class="card shadow-none border">
                                            <div class="card-body">
                                                <div class="rounded">
                                                    <div class="mb-3">
                                                        <select id="platforms" name="platforms[]" multiple="multiple" class="multiple-select" data-placeholder="Choose platforms" required>
                                                            @foreach ($platforms as $key => $platform)
                                                                <option value="{{ $key }}" {{ in_array($key, $selectedPlatformIds) ? 'selected' : '' }}>{{ old("platforms", $post->platforms) }}</option>
                                                            @endforeach
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
                                        <div class="card shadow-none border">
                                            <div class="card-body">
                                                <div class="rounded">
                                                    <div class="mb-3">
                                                        <select name="other_id" required class="single-select">
                                                            @foreach ($others as $key => $other)
                                                                <option {{ $post->other_id === $key ? 'selected' : '' }} value="{{ $key }}">{{ old("other_id", $post->other_id) }}</option>                                                                
                                                            @endforeach
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
                                        <label for="tags" class="form-label">Post Tags</label>
                                        <input type="text" class="form-control" value="{{ old("tags", $tags) }}" name="tags" data-role="tagsinput"  id="tags" required>

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
                                                        <img style="width: 540px" id="croppedImage" src="/storage/{{ $post->image ? $post->image->path : 'placeholders/thumbnail_placeholder.jpg' }}" class="img-responsive" alt="Cropped image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputAuthorThumbnail" class="form-label">Author of the Thumbnail</label>
                                        <input type="text" value='{{ old("author_thumbnail", $post->author_thumbnail) }}' class="form-control" name="author_thumbnail" id="inputAuthorThumbnail">

                                        @error('author_thumbnail')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputPostContent" class="form-label">Post Content</label>
                                        <textarea name="body" class="form-control" id="inputPostContent" rows="3">
                                            {{ old("body", str_replace('../../', '../../../', $post->body)) }}</textarea>   
                                    
                                        @error('body')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    @if ( auth()->user()->roles->contains('name', 'admin') )                                    
                                        <div class="form-check form-switch admin-approve-container">
                                            <input name='approved' {{ $post->approved ? 'checked' : '' }} class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label {{ $post->approved ? 'text-success' : 'text-danger' }}" for="flexSwitchCheckChecked">
                                                <b>{{ $post->approved ? 'Approved' : 'Not approved' }}</b>
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

<div class="modal fade" id="cropImageModal" tabindex="-1" aria-labelledby="cropImageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cropImageModalLabel">Crop Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <img id="imageToCrop" src="#" alt="Image to crop">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelCrop">Cancel</button>
                <button type="button" class="btn btn-primary" id="cropAndUpload">Crop and Upload</button>
            </div>
        </div>
    </div>
</div>

<!--end page wrapper -->
@endsection

@section("script")

<script src="{{ asset('admin_dashboard_assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('admin_dashboard_assets/plugins/input-tags/js/tagsinput.js') }}"></script>

{{-- jQuery --}}
<link href="{{ asset('admin_dashboard_assets/jquery/jquery-3.6.0.min.js') }}" rel="stylesheet" />

{{-- Crop --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>
$(document).ready(function () {

    ////// Cropping //////
    let cropper;
    let croppedImageDataURL;

    // Initialize the Cropper.js instance when the modal is shown
    $('#cropImageModal').on('shown.bs.modal', function() {
        cropper = new Cropper($('#imageToCrop')[0], {
            aspectRatio: 16 / 9,
            viewMode: 1,
            autoCropArea: 0.8,
        });
    });

    // Destroy the Cropper.js instance when the modal is hidden
    $('#cropImageModal').on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });

    let previousFileName = null; // Initialize with null

    // Show the image cropping modal when an image is selected
    $('#thumbnail').on('change', function(event) {
        const file = event.target.files[0];
        const fileReader = new FileReader();

        // Get the value from the file input element
        const filePath = $('#thumbnail').val();
        // Use JavaScript to extract only the file name
        const fileName = filePath.split('\\').pop();
        
        if (fileName === previousFileName) {
            clearSelectedImage();            
        }

        // Update the previous file name
        previousFileName = file.name;

        fileReader.onload = function(e) {
            $('#imageToCrop').attr('src', e.target.result);
            $('#cropImageModal').modal('show');
        };

        fileReader.readAsDataURL(file);
    });

   // Handle the "Crop and Upload" button click
    $('#cropAndUpload').on('click', function() {
        croppedImageDataURL = cropper.getCroppedCanvas().toDataURL();

        // Convert the cropped image to WebP
        convertToWebP(croppedImageDataURL);

        $('#cropImageModal').modal('hide');
        $('#croppedImage').attr('src', croppedImageDataURL);
        $('#croppedImage').show();
    });

    // Prevent modal from closing when clicking outside
    $('#cropImageModal').modal({
        backdrop: 'static',
        keyboard: false
    });

    // Handle the "Cancel" button click
    $('#cancelCrop').on('click', function() {
        clearSelectedImage();
        $('#cropImageModal').modal('hide');
    });

    // Clear selected image data and image preview
    function clearSelectedImage() {
        $('#thumbnail').val(''); // Clear the thumbnail input value
        $('#imageToCrop').attr('src', ''); // Clear the image preview
        $('#croppedImageData').val(''); // Clear the hidden input value
        $('#croppedImage').attr('src', '').hide(); // Remove the cropped image preview and hide it
    }

    // Function to convert the image to WebP
    function convertToWebP(dataURL) {
        const image = new Image();
        image.src = dataURL;

        image.onload = function() {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            canvas.width = image.width;
            canvas.height = image.height;
            context.drawImage(image, 0, 0, canvas.width, canvas.height);

            // Convert the canvas to WebP format
            canvas.toBlob(function(blob) {
                const reader = new FileReader();

                reader.onloadend = function() {
                    const webpDataURL = reader.result;

                    // Set the WebP data URL in the hidden input
                    $('#croppedImageData').val(webpDataURL);
                };

                // Convert the blob to a data URL with the "image/webp" MIME type
                blob.type = 'image/webp';
                reader.readAsDataURL(blob);
            }, 'image/webp');
        };
    }

    // Upload the cropped image to the server
    function uploadCroppedImage() {
        const formData = new FormData();
        formData.append('_token', $('input[name=_token]').val());
        formData.append('thumbnail', dataURLtoFile(croppedImageDataURL, 'cropped-image.png'));

        $.ajax({
            url: "{{ route('admin.posts.store') }}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status === 'success') {
                    $('#croppedImage').attr('src', "{{ env('APP_UPLOADS_URL') }}/" + response.filename);
                    $('#croppedImage').show();
                }
            },
            error: function(xhr, status, error) {
                // Handle errors
            },
        });
    }

    // Helper function to convert a data URL to a File object
    function dataURLtoFile(dataURL, filename) {
        const arr = dataURL.split(',');
        const mime = arr[0].match(/:(.*?);/)[1];
        const bstr = atob(arr[1]);
        let n = bstr.length;
        const u8arr = new Uint8Array(n);

        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }

        return new File([u8arr], filename, { type: mime });
    }
    ////// End of Cropping //////

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