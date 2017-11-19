<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $user = \Auth::user(); // Get the logged in user.
        if ($user) {
            // Only returns the logged in users competencies, at a later date will need to return all monitored competencies.
            $enrollments = \Auth::user()->monitoredCompetencies(); // Get all monitored competencies.
        } else {
            $enrollments = []; // Maybe an alternative view should be returned if the user isn't logged in.
        }
        return view ('dashboard.index', compact('enrollments'));
    }
}
