@extends('layouts.master')

@section('content')
    <h1>Courses</h1>
    <div class="card-deck">
        @for($i = 0; $i < 10; $i++)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card" style="width: 20rem;">
                    <div class="card-body">
                        <h4 class="card-title">Course Title</h4>
                        <p class="card-text">Some quick example text to build on the course title and make up the
                            bulk
                            of
                            the
                            card's content.</p>
                        <a href="#" class="btn btn-primary">View Course</a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Last updated 3 mins ago</small>
                    </div>
                </div>
            </div>
        @endfor
    </div>

@endsection