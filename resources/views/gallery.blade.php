@extends('layouts.master')
@section('title', 'Gallery')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Photo Gallery</h1>
        </div>
    </div>
</div>

<section class="py-5 text-center container">
    <div class="container">
        <p>
          <a href="/gallery/create" class="btn btn-primary my-2">Create Gallery</a>
        </p>
    </div>
</section>

<div class="container">
    @if (count($galleries) > 0)
    <div class="row">
        @foreach ($galleries as $gallery)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
              <img src="/storage/gallery_covers/{{ $gallery->cover_image }}" alt="{{ $gallery->cover_image}}" height="200px">
              <div class="card-body">
                <p class="card-text">{{ $gallery->description }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{ route ('gallery-show', $gallery->id) }}" type="button" class="btn btn-sm btn-outline-secondary">View</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
  </div>  
    @else
    <h3>No photo galleries yet.</h3>
    @endif
</div>
@endsection