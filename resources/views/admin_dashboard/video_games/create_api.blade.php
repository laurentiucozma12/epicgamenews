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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.video_games.create') }}">Add API Games</a></li>    
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add API Games</h5>
                <hr/>

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
                                                <th>Thumbnail</th>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Categories</th>
                                                <th>Platforms</th>
                                                <th>Add Game</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-game-api">
                                        </tbody>
                                    </table>
                                </div>

                            </div>                            
                        </div><!--end row-->
                    </div>

            </div>
        </div>
    </div>
</div>

{{-- Crop Modal --}}
<x-crop-modal />

@section("script")

<script>
    // Sending data to functions-admin.js file
    window.csrf_token = "{{ csrf_token() }}";    
</script>
@endsection