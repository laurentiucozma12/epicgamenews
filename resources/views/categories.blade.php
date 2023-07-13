@extends('layout')

@section('title', 'New Gaming News | Categories')

@section('content')

<div class="content-container">
    <h1>This is categories page!</h1>
    <h4>Those are the categories:</h4>
    <ul>
        @foreach ($tags as $tag)
            {{-- This anchor should take you on a page with posts with the related tag/category --}}
            <li><a href=""> {{ $tag->name }} </a></li>
        @endforeach
    </ul>
</div>

@endsection