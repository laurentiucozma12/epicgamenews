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
						<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.users.index') }}">All Users</a></li>
					</ol>
				</nav>
			</div>
		</div>
		<!--end breadcrumb-->
		
		<div class="card">
			<div class="card-body">
				<div class="d-lg-flex align-items-center mb-4 gap-3">
					<div class="position-relative d-flex align-items-center">
						<form action="{{ route('admin.users.search') }}" method="GET">
                            @csrf
                            
                            <input type="search" name="search" value="{{ isset($search) ? $search : '' }}" class="form-control ps-5 radius-30" placeholder="Search User"><span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                        </form>
						<span class="count count-total ms-2">Total: {{ count($users) }}</span>
						<span class="count count-active ms-2">Active: {{ count($users->where('deleted', 0)) }}</span>
						<span class="count count-inactive ms-2">Inactive: {{ count($users->where('deleted', '!==', 0)) }}</span> 
					</div>
					<div class="ms-auto"><a href="{{ route('admin.users.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New User</a></div>
				</div>
				<div class="table-responsive">
					<table class="table mb-0">
						<thead class="table-light">
							<tr>
								<th>Id</th>
								<th>Status</th>
								<th>Name</th>
								<th>Email</th>
								<th>Role</th>
								<th>Related Posts</th>
								<th>Related Video Games</th>
								<th>Related Categories</th>
								<th>Related Platforms</th>
								<th>Created at</th>
								<th>Updated at</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
							<tr>
								<td>
									<div class="d-flex align-items-center">
										<div class="ms-2">
											<h6 class="mb-0 font-14">{{ $user->id }}</h6>
										</div>
									</div>
								</td>
								<td>
									@if($user->deleted)
										<div class="text-danger bg-light-danger badge rounded-pill p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Inactive</div>
									@else
										<div class="text-info bg-light-info badge rounded-pill p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Active</div>
									@endif
								</td>
								<td>{{ $user->name }} </td>
								<td>{{ $user->email }} </td>
								<td>
									@foreach ($user->roles as $role)
										{{ $role->name }}
									@endforeach
								</td>
								<td>
									<a class='btn btn-primary btn-sm' href="{{ route('admin.users.show_posts', $user) }}">{{ count($user->posts) }} Posts</a>
								</td>
								<td>
									<a class='btn btn-primary btn-sm' href="{{ route('admin.users.show_video_games', $user) }}">{{ count($user->videoGames) }} Video Games</a>
								</td>
								<td>
									<a class='btn btn-primary btn-sm' href="{{ route('admin.users.show_categories', $user) }}">{{ count($user->categories) }} Categories</a>
								</td>
								<td>
									<a class='btn btn-primary btn-sm' href="{{ route('admin.users.show_platforms', $user) }}">{{ count($user->platforms) }} Platforms</a>
								</td>
								<td>{{ $user->created_at->diffForHumans() }}</td>
								<td>{{ $user->updated_at->diffForHumans() }}</td>
								<td>
									<div class="d-flex order-actions">
										<a href="{{ route('admin.users.edit', $user) }}" class=""><i class='bx bxs-edit'></i></a>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				<div class='mt-4'>
					{{ $users->onEachSide(0)->links('pagination::bootstrap-4') }}
				</div>
				
			</div>
		</div>


	</div>
</div>
<!--end page wrapper -->
@endsection