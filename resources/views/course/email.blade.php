@extends('layouts.master')

@section('content')
    <h1>Email {{ $course->name }} Students</h1>
    <form>
        <div class="form-group">
            <label for="emailSubject">Subject</label>
            <input type="text" class="form-control" id="emailSubject" aria-describedby="subjectHelp" placeholder="Subject">
        </div>
        <div class="form-group">
            <label for="emailBody">Message</label>
            <textarea class="form-control" id="emailBody" placeholder="Enter your message here..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary px-5">Send</button>
        <a href="{{ route('course.show', ['id' => $course->id]) }}" class="btn btn-secondary active ml-5 px-5" role="button" aria-pressed="true">Cancel</a>
    </form>

@endsection