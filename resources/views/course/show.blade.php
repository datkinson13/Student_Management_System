@extends('layouts.master')

@section('content')
    <div class="jumbotron">
        <h1 class="display-3">Course {{ $course }}
            <a class="btn btn-warning btn-lg" href="#" role="button">Edit Course</a>
            <a class="btn btn-success btn-lg" href="/course/{{$course}}/email" role="button">Email Students</a>
        </h1>
        <p class="lead">This is the first course. Obviously this is the best course.</p><a class="btn btn-primary btn-lg" href="#" role="button">Enroll</a>
        <hr class="my-4">
        <p>Okay, that may have been a lie. It may not be the best course but it is our first. We're trying okay.
            What you may not realize is... </p>
        @php
            echo file_get_contents('http://loripsum.net/api');
        @endphp
    </div>
@endsection
