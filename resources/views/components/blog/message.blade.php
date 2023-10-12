@props(['status'])

@if (Session::has('success'))
    <div class="general-message alert alert-success success">
        {{ session('success') }}
    </div>
@endif

@if (Session::has('danger'))
    <div class="general-message alert alert-danger danger }}">
        {{ session('danger') }}
    </div>
@endif

@if (Session::has('info'))
    <div class="info-message alert alert-info info }}">
        {{ session('info') }}
    </div>
@endif
