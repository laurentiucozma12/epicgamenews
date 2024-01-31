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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.seo.index_page') }}">All Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.seo.edit_page', $seo) }}">{{ $seo->page_name }} Page</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{ route('admin.seo.edit_page', $seo) }}"><h5 class="card-title mb-0">Edit SEO {{ $seo->page_name }}</h5></a>                
                    </div>
                    <div>
                        <div class="mb-0"><h5 class="card-title mb-0">Author: {{ old("author", $seo->author->name) }}</h5></div>
                    </div>
                </div>
                <hr/>

                <form action="{{ route('admin.seo.update_page', $seo) }}" method="POST">

                    @csrf
                    @method('PATCH')

                    <div class="form-body mt-4">

                        <div class="row">
                            <div class="col-5">
                                <div class="mb-3">
                                    <h5 class="mb-0"><label for="seoTitle" class="form-label">SEO {{ $seo->page_name }} Title (around 50-60 characters)</label></h5>
                                    <ul>
                                        <li>Should be unique for each page</li>
                                        <li>Keep it concise and relevant (around 50-60 characters)</li>
                                        <li>Include the primary keyword for the page</li>
                                        <li>Make it compelling and encourage clicks</li>
                                        <li>Avoid keyword stuffing</li>
                                    </ul>
                                    <input type="text" value='{{ old("title", $seo->title) }}' name="title" required class="form-control" id="seoTitle">

                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="mb-3">
                                    <h5 class="mb-0"><label for="seoKeywords" class="form-label">SEO {{ $seo->page_name }} Keywords (around 5-7 keywords)</label></h5>
                                    <ul>
                                        <li>Google doesn't use meta keywords for ranking, but some search engines might</li>
                                        <li>If used, keep it relevant to the content</li>
                                        <li>Avoid keyword stuffing</li>
                                        <li>Do NOT forget to use comma between keywords!</li>
                                        <li>(ex: world of warcraft, mmorpg, epic mount, guide, limiteed edition)</li>
                                    </ul>
                                    <input type="text" value='{{ old("keywords", $seo->keywords) }}' name="keywords" required class="form-control" id="seoKeywords">

                                    @error('keywords')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                                
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h5 class="mb-0"><label for="seoDescription" class="form-label">SEO {{ $seo->page_name }} Description (around 50-60 characters)</label></h5>
                                    <div class="d-flex">
                                        <ul class="me-4">
                                            <li>Unique and descriptive for each page</li>
                                            <li>Limit to around 150-160 characters</li>
                                            <li>Include the primary keyword naturally</li>
                                        </ul>                                
                                        <ul>
                                            <li>Provide a concise summary of the page content</li>
                                            <li>Encourage clicks with a call-to-action</li>
                                        </ul>                                
                                    </div>
                                    <textarea required class="form-control" name='description' id="seoDescription" rows="2">{{ old("description", $seo->description) }}</textarea>
                                    
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div><!--end row-->

                    </div>          
                    
                    <div class="d-flex justify-content-between">
                        <button class='btn btn-primary' type='submit'>Update SEO {{ $seo->page_name }}</button>
                    </div>
                </form><!--end form-->

            </div>
        </div>
    </div>
</div>

<!--end page wrapper -->
@endsection