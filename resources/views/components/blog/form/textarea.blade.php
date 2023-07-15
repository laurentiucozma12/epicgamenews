@props(['name', 'placeholder', 'value'])

<textarea required id="{{ $name }}" name='{{ $name }}' class="form-control" placeholder="{{ $placeholder }}" cols="30" rows="10">{{ $value }}</textarea>

@error($name)
<small class="text-danger">{{ $message }}</small>
@enderror
