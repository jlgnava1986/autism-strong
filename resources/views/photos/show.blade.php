@extends('layouts.master')

@section('content')
<div class="container">    
    <h3>{{ $photo->title }}</h3>
    <p>{{ $photo->description }}</p>
    <form action="{{ route ('photo-destroy', $photo->id)" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" name="button" class="btn btn-danger">Delete</button>
    <a href="{{ route('gallery-show', $photo->gallery->id) }}" class="btn btn-info">Go Back</a>
    <small>Size: {{ $photo->size }}</small>
    <hr>
    <img src="/storage/gallery/{{ $photo->gallery_id }}/{{ $photo->photo }}" alt="{{ $photo->photo }}">
@endsection