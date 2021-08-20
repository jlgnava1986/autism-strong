@extends('layouts.master')

@section('content')
<section class="py-5 text-center container">
    <div class="row-py-lg-5">
        <h1 class="fw-light">{{ $gallery->name }}</h1>
        <p class="lead text-muted">{{ $gallery->description }}</p>
        <p>
            <a href="/photos/create/{{$gallery->id}}" class="btn btn-primary my-2">Upload Photo</a>
            <a href="/gallery" class="btn btn-secondary my-2">Go Back</a>
        </p>
    </div>
</section>

<div class="container">
@if (count($gallery->photos) > 0)
    
    <div class="row">
        @foreach ($gallery->photos as $photo)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
              <img src="/storage/gallery/{{ $gallery->id }}/{{ $photo->photo }}" alt="{{ $photo->photo }}" height="200px">
              <div class="card-body">
                <p class="card-text">{{ $photo->description }}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="{{ route ('photo-show', $photo->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
                  </div><!--btn-group-->
                </div><!--d-flex-->
              </div><!-- card-body-->
          </div><!-- card-->
        </div><!-- col-md-4-->
        @endforeach
    </div><!-- row--> 
    @else
    <h3>No photos yet.</h3>
    @endif  
</div> <!-- container-->   
@endsection
