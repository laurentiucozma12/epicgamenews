
@extends("admin_dashboard.layouts.app")

@section("style")

<link href="{{ asset('admin_dashboard_assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin_dashboard_assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

@endsection
    
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
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.users.edit', $user) }}">Edit User {{ $user->name }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
          
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Edit User</h5>
                    <hr/>

                    <form action="{{ route('admin.users.update', $user) }}" method='post' enctype='multipart/form-data'>
                        @csrf
                        @method('PATCH')
    
                        <div class="form-body mt-4">
                            <div class="row">
                                <div class="col-12 col-lg-6">                                   

                                    <div class="mb-3">
                                        <label for="input_name" class="form-label">Name</label>
                                        <input name='name' type='text' class="form-control" id="input_name" value='{{ old("name", $user->name) }}'>
                                    
                                        @error('name')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="input_email" class="form-label">Email</label>
                                        <input name='email' type='email' class="form-control" id="input_email" value='{{ old("email", $user->email) }}'>
                                    
                                        @error('email')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="input_password" class="form-label">Password</label>
                                        <input name='password' type='password' class="form-control" id="input_password">
                                    
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
                                                            @foreach ($roles as $key => $role)
                                                                <option value="{{ $key }}" {{ in_array($key, $selectedRoleIds) ? 'selected' : '' }}>{{ $role }}</option>
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
                                    
                                </div>                                
                                <div class="col-12 col-lg-6">

                                    <div class="mb-3">

                                            <div>

                                                <div class="card shadow-none">
                                                    <div class="card-body p-0">
                                                        <label for="input_image" class="form-label">Image</label>
                                                        <input name='image' type='file' class="form-control" id="input_image">
                                                    
                                                        @error('image')
                                                            <p class='text-danger'>{{ $message }}</p>
                                                        @enderror                                                        
                                                    </div>
                                                </div>

                                                {{-- This label is invisible, just for design purpose --}}
                                                <label class="invisible"></label>

                                            </div>
                                            
                                            <div class='user-image'>
                                                <img src="{{ $user->image ? asset('storage/' . $user->image->path) : asset('storage/placeholders/user_placeholder.jpg') }}" alt="post thumbnail">
                                            </div>

                                    </div>

                                </div>

                                <div class="d-flex justify-content-between">
                                    <button class='btn btn-primary' type='submit'>Update User</button>

                                    <a 
                                    onclick='event.preventDefault(); document.getElementById("delete_user_{{ $user->id }}").submit()'
                                    href="#"
                                    class='btn btn-danger'>
                                        Delete User
                                    </a>
                                </div>

                            </div>
                        </div>
                    </form>

                    <form id='delete_user_{{ $user->id }}' action="{{ route('admin.users.destroy', $user) }}" method='POST'>@csrf @method('DELETE')</form>

                </div>
            </div>


        </div>
    </div>
    <!--end page wrapper -->
    @endsection

@section("script")
<script src="{{ asset('admin_dashboard_assets/plugins/select2/js/select2.min.js') }}"></script>

<script>
    $(document).ready(function () {

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

        setTimeout(() => {
            $(".general-message").fadeOut();
        }, 5000);

    });

</script>
@endsection