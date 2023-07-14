@props(['status'])

@if(session()->has($status));

    <div class="alert alert-{{ $status == 'sucess' ? 'info' : 'danger' }}">
        {{ session($status) }}
    </div>

@endif