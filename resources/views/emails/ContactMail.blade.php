@extends('layouts.master')

@section('content')
<h1>Contact Message</h1>
<p>Name: {{ $details ['name'] }}</p>
<p>E-Mail: {{ $details ['email'] }}</p>
<p>Message: {{ $details ['message'] }}</p>
@endsection