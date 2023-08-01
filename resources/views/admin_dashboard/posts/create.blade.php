@extends("admin_dashboard.layouts.app")

@section("style")
<link href="{{ asset('admin_dashboard_assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }} " rel="stylesheet" />

<link href="{{ asset('admin_dashboard_assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin_dashboard_assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

<link href="{{ asset('admin_dashboard_assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />

<style>
    .imageuploadify {
        margin: 0;
        max-width: 100%;
    }
</style>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.0/tinymce.min.js" integrity="nhtc4hkvw9rxs4ivm25pg3brruxcsjsaknsuggv71arm406g" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<script src="https://cdn.tiny.cloud/1/nhtc4hkvw9rxs4ivm25pg3brruxcsjsaknsuggv71arm406g/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection
    
@section("wrapper")
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Posts</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Orders</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add New Post</h5>
                <hr/>

                <form action="{{ route('admin.posts.store') }}" method="POST">
                    @csrf
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="border border-3 p-4 rounded">

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Post Title</label>
                                        <input type="email" class="form-control" id="inputProductTitle" placeholder="Enter post title">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Post Slug</label>
                                        <input type="email" class="form-control" id="inputProductTitle" placeholder="Enter post slug">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Post Excerpt</label>
                                        <textarea class="form-control" id="inputProductDescription" rows="3"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Post Category</label>                                        
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="rounded">
                                                    <div class="mb-3">
                                                        <select class="single-select">
                                                            @foreach ($categories as $key => $category)
                                                                <option value="{{ $key }}">{{ $category }}</option>                                                                
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                            
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Post Thumbnail</label>
                                        <input id="image-uploadify" type="file" accept="image/*" multiple>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Post Content</label>
                                        <textarea id="post_content" class="form-control" id="inputProductDescription" rows="3"></textarea>
                                    </div>

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
<script src="{{ asset('admin_dashboard_assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js') }}"></script>

<script src="{{ asset('admin_dashboard_assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('admin_dashboard_assets/plugins/input-tags/js/tagsinput.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#image-uploadify').imageuploadify();
    });

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
        selector: 'textarea#post_content',
        plugins: 'advlist autolink lists link image media charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
        height: '500',

        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code | rtl ltr',
        toolbar_mode: 'floating',

        image_title: true,
        automatic_uploads: true,

        images_upload_handler: images_upload_handler,
    });

</script>
@endsection