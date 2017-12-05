<?php

namespace App\Http\Controllers;

use App\Employer;
use App\Http\Requests\StoreEmployer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Employer::class);
        return view('employer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreEmployer  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployer $request)
    {
        // This request has already been validated and authorized via StoreEmployer.

        Employer::create(['user_id'     => \Auth::id(),
                          'company'     => $request->input('company'),
                          'address'     => $request->input('address'),
                          'phone'       => $request->input('phone'),
                          'domain'      => strtolower($request->input('domain'))
        ]);

        return redirect(route('users.show', \Auth::id()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function show(Employer $employer)
    {
        $this->authorize('view', $employer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function edit(Employer $employer)
    {
        $this->authorize('update', $employer);
        return view('errors.indev');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employer $employer)
    {
        $this->authorize('update', $employer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employer $employer)
    {
        $this->authorize('update', $employer);
    }
}
