
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.users.create') }}">New User</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add New User</h5>
                <hr/>

                <form action="{{ route('admin.users.store') }}" method='POST' enctype='multipart/form-data'>
                    @csrf

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="rounded">

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input name='name' type='text' class="form-control" id="name" value='{{ old("name") }}'>
                                    
                                        @error('name')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input name='email' type='email' class="form-control" id="email" value='{{ old("email") }}'>
                                    
                                        @error('email')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input name='password' type='password' class="form-control" id="password">
                                    
                                        @error('password')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">User Role</label>                                        
                                        <div class="card shadow-none">
                                            <div class="card-body p-0">
                                                <div class="rounded">
                                                    <div class="mb-3">
                                                        <select id="roles" name="roles[]" multiple="multiple" class="multiple-select" data-placeholder="Choose roles" required>
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role->id }}" {{ $role->name === 'user' ? 'selected' : '' }}>
                                                                    {{ $role->name }}
                                                                </option>     
                                                            @endforeach
                                                        </select>

                                                        @error('roles')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror

                                                        @if($errors->has('all_fields'))
                                                            <p class="text-danger">{{ $errors->first('all_fields') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button class='btn btn-primary' type='submit'>Add User</button>
                                    
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