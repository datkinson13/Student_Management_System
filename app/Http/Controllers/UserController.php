<?php

namespace App\Http\Controllers;

use App\Administrator;
use App\Facilitator;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'asc')->get();

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      User::where('id', $user->id)
            ->update([
              'Fname' => $request->input('Fname'),
              'Lname' => $request->input('Lname'),
              'email' => $request->input('email'),
              'DOB' => $request->input('DOB'),
              'address' => $request->input('address'),
              'phone' => $request->input('phone'),
              'mobile' => $request->input('mobile')
            ]);

        // This will require an authorization check.
        if ( isset ($request['admin'])) {
            Administrator::create(['user_id' => $user->id]);
        } else {
            $admin_id = Administrator::where('user_id', $user->id)->first();
            Administrator::destroy($admin_id->id);
        }

        if ( isset ($request['facil'])) {
            Facilitator::create(['user_id' => $user->id]);
        } else {
            $facil_id = Facilitator::where('user_id', $user->id)->first();
            Facilitator::destroy($facil_id->id);
        }

        return redirect()->route('users.show', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
