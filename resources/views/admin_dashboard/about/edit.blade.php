
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