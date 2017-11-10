<?php

namespace App\Http\Controllers;

use App\SystemRole;
use App\User;
use Gate;
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
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'password' => 'min:6',
        'confirmPassword' => 'required_with:password|same:password|min:6'
      ]);

      User::create([
              'Fname' => $request->input('Fname'),
              'Lname' => $request->input('Lname'),
              'email' => $request->input('email'),
              'DOB' => $request->input('DOB'),
              'address' => $request->input('address'),
              'phone' => $request->input('phone'),
              'mobile' => $request->input('mobile'),
              'password' => bcrypt($request->input('password'))
            ]);

        return redirect('/users');
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

        // Only do the next steps if the user is authorized.
        if (Gate::allows('change-permissions')) {
            // This user has the 'change-permissions' permission.
            $role_arr = is_array($request->input('roles')) ? $request->input('roles') : array();
            foreach ($user->roles as $role) {
                // Iterate through the roles the user currently has.
                if (!array_key_exists($role->id, $role_arr)) {
                    // They don't have this permission anymore.
                    // Get the entry.
                    $sys_role = SystemRole::where('user_id', $user->id)->where('role_id', $role->id)->first();
                    // Delete it.
                    $sys_role->delete();
                }
            }

            foreach ($role_arr as $role_id => $role) {
                // Iterate through the roles that have been submitted.
                // Double check that the role should be added to the user.
                if ($role) {
                    // Does the user already have this role?
                    $user_role = SystemRole::where('user_id', $user->id)->where('role_id', $role_id)->first();
                    if (!$user_role) {
                        // Add this role to the user.
                        SystemRole::create(['user_id' => $user->id, 'role_id' => $role_id]);
                    }
                }
            }
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
      User::where('id', $user->id)->delete();

      return redirect('/users');
    }
}
