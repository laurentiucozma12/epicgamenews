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
						<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.tags.index') }}">All Tags</a></li>
					</ol>
				</nav>
			</div>
		</div>
		<!--end breadcrumb-->
		
		<div class="card">
			<div class="card-body">
				<div class="d-lg-flex align-items-center mb-4 gap-3">
					<div class="position-relative">					
                        <form action="{{ route('admin.tags.search') }}" method="GET">
                            @csrf
                            
                            <input type="search" name="search" value="{{ isset($search) ? $search : '' }}" class="form-control ps-5 radius-30" placeholder="Search Tag"><span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                        </form>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table mb-0">
						<thead class="table-light">
							<tr>
								<th>Id</th>
								<th>Name</th>
								<th>Related Posts</th>
								<th>Created at</th>
								<th>Updated at</th>
								<th>Created by</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($tags as $tag)
							<tr>
								<td>
									<div class="d-flex align-items-center">
										<div class="ms-2">
											<h6 class="mb-0 font-14">{{ $tag->id }}</h6>
										</div>
									</div>
								</td>
								<td>{{ $tag->name }} </td>
								<td>
									<a class='btn btn-primary btn-sm' href="{{ route('admin.tags.show', $tag) }}">{{ count($tag->posts) }} Related Posts</a>
								</td>
								<td>{{ $tag->created_at->diffForHumans() }}</td>
								<td>{{ $tag->updated_at->diffForHumans() }}</td>
								<td>{{ $tag->user->name }} </td>
								<td>
									<div class="d-flex order-actions">
										<a href="#" onclick="event.preventDefault(); document.getElementById('delete_form_{{ $tag->id }}').submit();" class="ms-3"><i class='bx bxs-trash'></i></a>
									
										<form method='post' action="{{ route('admin.tags.destroy', $tag) }}" id='delete_form_{{ $tag->id }}'>@csrf @method('DELETE')</form>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				
				<div class='mt-4'>
					{{ $tags->onEachSide(0)->links('pagination::bootstrap-4') }}
				</div>
				
			</div>
		</div>


	</div>
</div>
<!--end page wrapper -->
@endsection