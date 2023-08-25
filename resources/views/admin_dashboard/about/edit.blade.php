
@extends("admin_dashboard.layouts.app")
    
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
                                        <label for="input_name" class="form-label">Name</label>
                                        <input name='name' type='text' class="form-control" id="input_name">
                                    
                                        @error('name')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="input_email" class="form-label">Email</label>
                                        <input name='email' type='email' class="form-control" id="input_email">
                                    
                                        @error('email')
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

        setTimeout(() => {
            $(".general-message").fadeOut();
        }, 5000);

    });
</script>
@endsection