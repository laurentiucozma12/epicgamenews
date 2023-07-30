@extends("admin_dashboard.layouts.app")

@section("style")
<link href="{{ asset('admin_dashboard_assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin_dashboard_assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin_dashboard_assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

<style>.imageuploadify { margin: 0; max-width: 100%; }</style>

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
                <h5 class="card-title">Testing Add New Post</h5>
                <hr/>

                <form action="{{ route('admin.tests.store') }}" method="POST">
                    @csrf
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="border border-3 p-4 rounded">

                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">TESTING Post Content</label>
                                        <textarea id="test" class="form-control" id="inputProductDescription" rows="3"></textarea>
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
<script>
    $(document).ready(function () {
        $('#image-uploadify').imageuploadify();
    })

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

tinymce.init({
    selector: 'textarea#test',
    plugins: 'image code',
    height: 500,
    toolbar: 'undo redo | link image | code',
    /* enable title field in the Image dialog*/
    image_title: true,
    /* enable automatic uploads of images represented by blob or data URIs*/
    automatic_uploads: true,
    /*
    URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
    images_upload_url: 'postAcceptor.php',
    here we add custom filepicker only to Image dialog
    */
    file_picker_types: 'image',
    /* and here's our custom image picker*/
    file_picker_callback: (cb, value, meta) => {
        const input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        input.addEventListener('change', (e) => {
            const file = e.target.files[0];

            const reader = new FileReader();
            reader.addEventListener('load', () => {
            /*
                Note: Now we need to register the blob in TinyMCEs image blob
                registry. In the next release this part hopefully won't be
                necessary, as we are looking to handle it internally.
            */
            const id = 'blobid' + (new Date()).getTime();
            const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            const base64 = reader.result.split(',')[1];
            const blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);

            /* call the callback and populate the Title field with the file name */
            cb(blobInfo.blobUri(), { title: file.name });
            });
            reader.readAsDataURL(file);
        });

        input.click();
    },
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
});
</script>
@endsection