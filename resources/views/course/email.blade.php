@extends('layouts.master')

@section('content')
    <h1>Course {{ $course }}</h1>
    <form>
        <div class="form-group">
            <label for="emailSubject">Subject</label>
            <input type="text" class="form-control" id="emailSubject" aria-describedby="subjectHelp" placeholder="Subject">
        </div>
        <div class="form-group">
            <label for="emailBody">Message</label>
            <textarea class="form-control" id="emailBody" placeholder="Enter your message here..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary px-5">Send</button><button type="submit" class="btn btn-secondary ml-5 px-5">Cancel</button>
    </form>

@endsection