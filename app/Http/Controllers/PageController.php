<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $enrollments = \Auth::user()->competencies;
        return view ('dashboard.index', compact('enrollments'));
    }
}
