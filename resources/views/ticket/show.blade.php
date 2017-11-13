@extends('layouts.master')

@section('content')
<h1>Ticket: #{{ $ticket->id }}</h1>
<h5>Ticket ID: </h5>
<p>#{{ $ticket->id }}</p>
<h5>Ticket created: </h5>
<p>{{ $ticket->created_at }}</p>
<h5>Ticket last updated: </h5>
<p>{{ $ticket->updated_at }}</p>
<h5>Ticket Priority: </h5>
<p>{{ $ticket->priority }}</p>
<h5>Ticket Status: </h5>
<p>{{ $ticket->status }}</p>
<h5>Subject: </h5>
<p>{{ $ticket->subject }}</p>
<h5>Description: </h5>
<p>{{ $ticket->description }}</p>
<hr/>

<div class = "comments">
  <ul class = "list-group">
    @foreach($ticket->comments as $comment)
      <li class = "list-group-item">
        {{ $comment->user->Fname }} {{ $comment->user->Lname }}<br/>
        <em>{{ $comment->created_at->diffForHumans() }}</em><br/><br/>
        {{ $comment->body }}
      </li>
    @endforeach
  </ul>
</div>

<div class = "card">
  <div class = "card-block">
    <form method = "POST" action="/tickets/{{ $ticket->id }}/comments">
      {{ csrf_field() }}

      <div class = "form-group">
        <textarea name = "body" id = "body" placeholder = "Enter comment..." class = "form-control"></textarea>
      </div>
      <div class = "form-group">

<!--
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="submit" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Submit as:
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Open</a>
            <a class="dropdown-item" href="#">Pending</a>
            <a class="dropdown-item" href="#">Solved</a>
          </div>
        </div> -->
        <button class="btn btn-primary" type="submit">Add comment</button>
      </div>
    </form>
  </div>
</div>
@endsection
