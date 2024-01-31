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
                        <li class="breadcrumb-item"><a href="{{ route('admin.seo_platforms') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.seo_platforms') }}">SEO Platforms</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit SEO Home</h5>
                <hr/>

                {{-- <form action="{{ route('admin.categories.update', $category) }}" method="POST"> --}}
                <form action="" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="mb-3">
                                    <label for="seoHomeTitle" class="form-label">SEO Home Title</label>
                                    <input type="text" value='{{ old("title", $title) }}' name="title" required class="form-control" id="seoHomeTitle">

                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="seoHomeDescription" class="form-label">SEO Home Description</label>
                                    <input type="text" value='{{ old("description", $description) }}' name="description" required class="form-control" id="seoHomeDescription">

                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="seoHomeKeywords" class="form-label">SEO Home Keywords</label>
                                    <input type="text" value='{{ old("keywords", $keywords) }}' name="keywords" required class="form-control" id="seoHomeKeywords">

                                    @error('keywords')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                        </div><!--end row-->
                    </div>          
                    
                    <div class="d-flex justify-content-between">
                        <button class='btn btn-primary' type='submit'>Update SEO Home</button>
                    </div>
                </form><!--end form-->

            </div>
        </div>
    </div>
</div>

<!--end page wrapper -->
@endsection