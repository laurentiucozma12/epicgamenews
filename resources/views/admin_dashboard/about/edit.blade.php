
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">About Page</li>
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

                                    <div class="mb-3">
                                        <label for="first_text" class="form-label">"Who are we" text</label>
                                        <textarea name='first_text' class="form-control" id="first_text"></textarea>
                                    
                                        @error('first_text')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="second_text" class="form-label">Second text</label>
                                        <textarea name='second_text' class="form-control" id="second_text"></textarea>
                                    
                                        @error('second_text')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class='row'>
                                        <div class='col-md-8'>
                                            <div class="mb-3">
                                                <label for="input_image1" class="form-label">First Image</label>
                                                <input name='first_image' type='file' class="form-control" id="input_image1">
                                            
                                                @error('first_image')
                                                    <p class='text-danger'>{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='user-image'>

                                            </div>
                                        </div>
                                    </div>

                                    <div class='row'>
                                        <div class='col-md-8'>
                                            <div class="mb-3">
                                                <label for="input_image2" class="form-label">Second Image</label>
                                                <input name='second_image' type='file' class="form-control" id="input_image2">
                                            
                                                @error('second_image')
                                                    <p class='text-danger'>{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='user-image'>

                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="our_mission" class="form-label">Our Mission</label>
                                        <textarea id="our_mission" name="our_mission" class="form-control" id="our_mission" rows="3"></textarea>   
                                    
                                        @error('our_mission')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="our_vision" class="form-label">Our Vision</label>
                                        <textarea id="our_vision" name="our_vision" class="form-control" id="our_vision" rows="3"></textarea>   
                                    
                                        @error('our_vision')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="services" class="form-label">Services</label>
                                        <textarea id="services" name="body" class="form-control" id="services" rows="3"></textarea>   
                                    
                                        @error('services')
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
    let initTinyMCE = (id) => {
        tinymce.init({
            selector: 'textarea#' + id,
            plugins: 'advlist autolink lists link charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            height: '300',

            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link code | rtl ltr',
            toolbar_mode: 'floating',
        });       
    }
    
    initTinyMCE('our_mission');
    initTinyMCE('our_vision');
    initTinyMCE('services');

    setTimeout(() => {
        $(".general-message").fadeOut();
    }, 5000);

});
</script>
@endsection