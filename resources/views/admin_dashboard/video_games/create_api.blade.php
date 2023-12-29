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
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.video_games.index') }}">All Video Games</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.video_games.create') }}">Add New Video Game</a></li>    
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add New Video Game</h5>
                <hr/>

                <form action="{{ route('admin.video_games.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="mb-3">
                                    <label for="gameName" class="form-label">Video Game Name</label>
                                    <div class="input-group row">
                                        <div class="col-4">
                                            <input type="text" value='{{ old("name") }}' name="name" required class="form-control" id="gameName">
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-primary" id="searchGameButton">Search Game</button>
                                        </div>
                                    </div>
                                
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Categories</th>
                                                <th>Platforms</th>
                                                <th>Add Game</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

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

@section("script")
<script>
$(document).ready(function() {
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