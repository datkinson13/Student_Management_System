<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Ticket $ticket, Request $request)
    {
      Comment::create([
        'body' => $request->input('body'),
        'ticket_id' => $ticket->id,
        'user_id' => Auth::id()
      ]);

      Ticket::where('id', $ticket->id)
            ->update([
              'updated_at' => now()
            ]);

      return redirect()->route('tickets.show', ['ticket' => $ticket]);
    }
}
