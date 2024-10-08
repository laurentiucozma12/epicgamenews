@extends("admin_dashboard.layouts.app")

@section('style')
{{-- <style>
    .permission {
        background-color: white;
        padding: 5px 10px;
        display: inline-block;
        font-size: 15px;
        margin: 10px;
        cursor: pointer;    
        width: 100%;
    }
</style> --}}
@endsection

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
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add New Role</h5>
                <hr/>

                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="border border-3 p-4 rounded">

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Role Name</label>
                                        <input type="text" value='{{ old("name") }}' name="name" required class="form-control" id="inputProductTitle">

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
                                                            <input type="checkbox" name='permissions[]' value='{{ $permissions[$j]->id }}'>{{ $permissions[$j]->name }}
                                                        </label>
                                                    @endfor
                                                </div>

                                                @php
                                                    $start = $end;
                                                @endphp

                                            @endfor

                                        </div>

                                    </div>
                                    
                                    <button class='btn btn-primary' type='submit'>Add Role</button>

                                </div>
                            </div>                            
                        </div><!--end row-->
                    </div>                        
                </form><!--end form-->
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->
@endsection