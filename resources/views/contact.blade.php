@extends('layouts.master')
@section('title', 'Contact')
@section('content')
<section style="padding-top:60px">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Contact Us
                    </div>
                    <div class="card-body">
                        @if (Session::has('message_sent'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('message_sent')}}
                        </div>
                        @endif
                        <form method="post" action="{{ route('contact-send') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="E-Mail">E-Mail</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="Message">Message</label>
                                <textarea name="message" class="form-control" required></textarea>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection