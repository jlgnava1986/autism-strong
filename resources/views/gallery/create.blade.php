@extends('layouts.master')

@section('content')
<section style="padding-top:60px">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Create Photo Gallery
                    </div>
    <form method="post" action="/gallery/store" enctype="multipart/form-data">
    @method('post')
        @csrf
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
  </div>
  <br>
  <div class="form-group">
    <label for="description">Description</label>
    <input type="text" class="form-control" name="description" id="description" placeholder="Enter description">
  </div>
  <br>
  <div class="form-group">
    <label for="cover-image">Cover Image</label>
    <input type="file" class="form-control" name="cover-image" id="cover-image">
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