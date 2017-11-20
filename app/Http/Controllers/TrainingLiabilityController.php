<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingLiabilityController extends Controller
{
    public function index()
    {
      return view('trainingliability.index');
    }
}
