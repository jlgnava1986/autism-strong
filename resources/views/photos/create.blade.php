@extends('layouts.master')

@section('content')
<section style="padding-top:60px">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Upload Photo
                    </div>
    <form method="post" action="/photos/store" enctype="multipart/form-data">
        @csrf
    <input type="hidden" name="gallery-id" value="{{ $galleryId }}">
  <div class="form-group">
    <label for="name">Title</label>
    <input type="text" class="form-control" name="title" id="title" placeholder="Title">
  </div>
  <br>
  <div class="form-group">
    <label for="description">Description</label>
    <input type="text" class="form-control" name="description" id="description" placeholder="Enter description">
  </div>
  <br>
  <div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" class="form-control" name="photo" id="photo">
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</div>
</div>
</div>
</section>
@endsection