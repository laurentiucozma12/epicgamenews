@extends("admin_dashboard.layouts.app")

@section("wrapper")
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Roles</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.roles.index') }}">All Roles</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.roles.edit', $role) }}"> {{ $role->name }}</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Role: {{ $role->name }}</h5>
                <hr/>

                <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Role Name</label>
                                        <input type="text" value='{{ old("name", $role->name) }}' name="name" required class="form-control" id="inputProductTitle">

                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Role Permissions</label>

                                        <div class="row">

                                            @php                                                
                                                $the_count = count($permissions);
                                                $start = 0;
                                            @endphp

                                            @for ($i = 1; $i <= 3; $i++)

                                                @php
                                                    $end = round($the_count * ($i / 3));
                                                @endphp

                                                <div class="col-md-4"> 
                                                    @for($j = $start; $j < $end; $j++)
                                                        <label class="permission">
                                                            <input {{ $role->permissions->contains( $permissions[$j]->id ) ? 'checked' : '' }} type="checkbox" name='permissions[]' value='{{ $permissions[$j]->id }}'>{{ $permissions[$j]->name }}
                                                        </label>
                                                    @endfor
                                                </div>

                                                @php
                                                    $start = $end;
                                                @endphp

                                            @endfor

                                        </div>

                                    </div>
                                    
                                    <div class="d-flex justify-content-between">
                                        <button class='btn btn-primary' type='submit'>Update Role</button>

                                        <a 
                                        class='btn btn-danger'
                                        onclick="event.preventDefault();document.getElementById('delete_role_{{ $role->id }}').submit()"
                                        href="#">
                                            Delete Role
                                        </a>
                                    </div>

                            </div>                            
                        </div><!--end row-->
                    </div>                        
                </form><!--end form-->

                <form id="delete_role_{{ $role->id }}" method="POST" action="{{ route('admin.roles.destroy', $role) }}">
                    @csrf
                    @method('DELETE')
                </form>

            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->
@endsection