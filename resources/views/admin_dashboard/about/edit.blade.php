
@extends("admin_dashboard.layouts.app")

@section("style")
    <script src="https://cdn.tiny.cloud/1/nhtc4hkvw9rxs4ivm25pg3brruxcsjsaknsuggv71arm406g/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section("wrapper")
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">About</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="bx bx-home-alt"></i></a></li>                  
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.about.edit') }}">About Page</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit About Page</h5>
                <hr/>

                <form action="{{ route('admin.about.update') }}" method='post' enctype='multipart/form-data'>
                    @csrf

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="border border-3 p-4 rounded">

                                    {{-- <div class="mb-3">
                                        <label for="about_first_text" class="form-label">"Who are we" text</label>
                                        <textarea name='about_first_text' class="form-control" id="about_first_text">{{ old("about_first_text", $about->about_first_text) }}</textarea>
                                    
                                        @error('about_first_text')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class='row mb-3'>
                                        <div class='col-md-6'>
                                            <div class="mb-3">
                                                <label for="input_image1" class="form-label">First Image (Max 540 x 340)</label>
                                                <input name='about_first_image' type='file' class="form-control" id="input_image1">
                                            
                                                @error('about_first_image')
                                                    <p class='text-danger'>{{ $message }}</p>
                                                @enderror
                                            </div>
                                        
                                            <hr>
                                            <img class='img-fluid' src="{{ asset('storage/' . $about->about_first_image) }}">
                                        </div>

                                        <div class='col-md-6'>
                                            <div class="mb-3">
                                                <label for="input_image2" class="form-label">Second Image (Max 540 x 340)</label>
                                                <input name='about_second_image' type='file' class="form-control" id="input_image2">
                                            
                                                @error('about_second_image')
                                                    <p class='text-danger'>{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <hr>
                                            <img class='img-fluid' src="{{ asset('storage/' . $about->about_second_image) }}">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="about_our_mission" class="form-label">Our Mission</label>
                                        <textarea id="about_our_mission" name="about_our_mission" class="form-control" rows="3">{{ old("about_our_mission", $about->about_our_mission) }}</textarea>   
                                    
                                        @error('about_our_mission')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="about_our_vision" class="form-label">Our Vision</label>
                                        <textarea id="about_our_vision" name="about_our_vision" class="form-control" rows="3">{{ old("about_our_vision", $about->about_our_vision) }}</textarea>   
                                    
                                        @error('about_our_vision')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div> --}}
                                    <div class="mb-3">
                                        <label for="description" class="form-label">About Description</label>
                                        <textarea name="description" class="form-control" id="description" rows="3">
                                            {{ old("description", str_replace('../../', '../../../', $about->description)) }}
                                        </textarea>   
                                    
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <button class='btn btn-primary' type='submit'>Update</button>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </form>

            </div>
        </div>


    </div>
</div>
<!--end page wrapper -->
@endsection

@section("script")
<script>
$(document).ready(function () {

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
        selector: "#description",
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
        });




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