
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.video_games.edit', $video_game) }}">Edit Video Game {{ $video_game->name }}</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Video Game: {{ $video_game->name }}</h5>
                <hr/>

                <form action="{{ route('admin.video_games.update', $video_game) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="border border-3 p-4 rounded">

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Video Game Name</label>
                                        <input type="text" value='{{ old("name", $video_game->name) }}' name="name" required class="form-control" id="inputProductTitle">

                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Video Game Slug</label>
                                        <input type="text" value='{{ old("slug", $video_game->slug) }}' name="slug" required class="form-control" id="inputProductTitle">

                                        @error('slug')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="com-md-8">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <label for="file" class="form-label">Video Game Thumbnail (Max 1920 x 1080)</label>
                                                        <input id='thumbnail' name='thumbnail' id="file" type="file">

                                                        @error('thumbnail')
                                                            <p class='text-danger'>{{ $message }}</p>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="com-md-4">
                                                <img style="width: 540px" src="/storage/{{ $video_game->image ? $video_game->image->path : 'placeholders/thumbnail_placeholder.jpg' }}" class="img-responsive" alt="Post Thumbnail">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="update-delete-btn-container">
                                        <button class='btn btn-primary' type='submit'>Update Video Game</button>

                                        <a 
                                        class='btn btn-danger'
                                        onclick="event.preventDefault();document.getElementById('delete_video_game_{{ $video_game->id }}').submit()"
                                        href="#">
                                            Delete Video Game
                                        </a>
                                    </div>

                                </div>
                            </div>                            
                        </div><!--end row-->
                    </div>                        
                </form><!--end form-->
                
                <form id="delete_video_game_{{ $video_game->id }}" method="POST" action="{{ route('admin.video_games.destroy', $video_game) }}">
                    @csrf
                    @method('DELETE')
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
        $('.general-message').fadeOut();
    }, 5000);

});

</script>
@endsection