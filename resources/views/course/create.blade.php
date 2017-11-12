@extends('layouts.master')

@section('content')
    <form method="POST" action="{{ route('course.store') }}">
        {{ csrf_field() }}
        <div class="jumbotron">
            <a href="/course/create">
                <button class="btn btn-primary user-profile-buttons">Save</button>
            </a>
            <div class="form-group">
                <input type="text" class="form-control-lg" name="name" id="name" placeholder="Course Title">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="subtitle">
            </div>
            <hr class="my-4">
            <div class="form-group">
                <textarea class="form-control" name="description" id="description" placeholder="Description...."></textarea>
            </div>
        </div>
    </form>
@endsection
