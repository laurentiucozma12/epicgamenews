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
						<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.users.index') }}">All Users</a></li>
						<li class="breadcrumb-item active text-white" aria-current="page">{{$user->name}}'s Posts</li>
					</ol>
				</nav>
			</div>
		</div>
		<!--end breadcrumb-->
		
		<div class="card">
			<div class="card-body">
				<div class="d-lg-flex align-items-center mb-4 gap-3">
					<div class="ms-auto"><a href="{{ route('admin.posts.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New Post</a></div>
				</div>
				<div class="table-responsive">
					<table class="table mb-0">
						<thead class="table-light">
							<tr>
								<th>Id</th>
								<th>Status</th>
								<th>Thumbnail</th>
								<th>Title</th>
								<th>Excerpt</th>
								<th>Video Game</th>
								<th>Created at</th>
								<th>Updated at</th>
								<th>Views</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($posts as $post)
							<tr>
								<td>
									<div class="d-flex align-items-center">
										<div class="ms-2">
											<h6 class="mb-0 font-14">{{ $post->id }}</h6>
										</div>
									</div>
								</td>
								<td>
									@if(intval($post->deleted) === 0)
										<div class="text-info bg-light-info badge rounded-pill p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Approved</div>
									@else
										<div class="text-danger bg-light-danger badge rounded-pill p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Not Approved</div>
									@endif
								</td>
								<td>
									@if ($post->image)
										<img src="{{ asset('storage/images/300x169/' . $post->image->name) }}" width='50' alt="{{ $post->image->name }}">
									@else
										<img src="{{ asset('storage/placeholders/thumbnail_placeholder.jpg') }}" width='50' alt="Img Placeholder">
									@endif
								</td>
								<td>{{ $post->title }} </td>
								<td>{{ $post->excerpt }}</td>
								<td>{{ $post->video_game->name }}</td>
								<td>{{ $post->created_at->diffForHumans() }}</td>                                        
								<td>{{ $post->updated_at->diffForHumans() }}</td>                                        
								<td>{{ $post->views }}</td>                                        
								<td>
									<div class="d-flex order-actions">
										<a href="{{ route('admin.posts.edit', $post) }}" class=""><i class='bx bxs-edit'></i></a>
										<a href="#" onclick="event.preventDefault(); document.getElementById('delete_form_{{ $post->id }}').submit();" class="ms-3"><i class='bx bxs-trash'></i></a>
									
										<form method='post' action="{{ route('admin.posts.destroy', $post) }}" id='delete_form_{{ $post->id }}'>@csrf @method('DELETE')</form>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				
				<div class='mt-4'>
					{{ $posts->onEachSide(0)->links('pagination::bootstrap-4') }}
				</div>

			</div>
		</div>


	</div>
</div>
<!--end page wrapper -->
@endsection