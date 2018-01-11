<?php

namespace App\Http\Controllers;

use App\SystemRole;
use App\User;
use Gate;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->filter(function ($value) {
            return \Auth::user()->can('view', $value);
        })->all();

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);
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
      $this->authorize('create', User::class);

      $this->validate($request, [
        'password' => 'min:6',
        'confirmPassword' => 'required_with:password|same:password|min:6'
      ]);

      if(isset($request['avatar'])) {
        $avatar = $request->file('avatar');
        $fileName = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $fileName));
      } else {
        $fileName = 'default.jpg';
      }

      if(isset($request['identification'])) {
        $identification_file = $request->file('identification');
        $identification_upload = time() . '.' . $identification_file->getClientOriginalExtension();
        $identification_file->storePubliclyAs('/uploads/identification/', $identification_upload, 'public');
      } else {
        $identification_upload = NULL;
      }

      User::create([
              'Fname' => $request->input('Fname'),
              'Lname' => $request->input('Lname'),
              'email' => $request->input('email'),
              'DOB' => $request->input('DOB'),
              'address' => $request->input('address'),
              'phone' => $request->input('phone'),
              'mobile' => $request->input('mobile'),
              'avatar' => $fileName,
              'identification' => $identification_upload,
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
        $this->authorize('view', $user);
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
        $this->authorize('update', $user);

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
      $this->authorize('update', $user);

      if(isset($request['avatar'])) {
        $avatar = $request->file('avatar');
        $fileName = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $fileName));
      } else {
        $fileName = $user->avatar;
      }

      if(isset($request['identification'])) {
        $identification_file = $request->file('identification');
        $identification_upload = time() . '.' . $identification_file->getClientOriginalExtension();
        $identification_file->storePubliclyAs('/uploads/identification/', $identification_upload, 'public');
      } else {
        $identification_upload = $user->identification;
      }

      User::where('id', $user->id)
            ->update([
              'Fname' => $request->input('Fname'),
              'Lname' => $request->input('Lname'),
              'email' => $request->input('email'),
              'DOB' => $request->input('DOB'),
              'address' => $request->input('address'),
              'phone' => $request->input('phone'),
              'mobile' => $request->input('mobile'),
              'avatar' => $fileName,
              'identification' => $identification_upload,
            ]);

        // Only do the next steps if the user is authorized.
        if (\Auth::user()->can('permissions', User::class)) {
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
        $this->authorize('delete', $user);

        $del_user = User::where('id', $user->id); // Get the user that is trying to be deleted.
        if (Gate::denies('user-delete')) { // Is this 'managing' user allowed to delete users?
            // This user isn't allowed to delete other users.
            //   Ensure that the only returned result is themselves.
            //   This doesn't mean that all deletes will result in themselves being deleted.
            //   It just prevents the user from deleting other users.
            //   Because the route will be hidden they should reach this point but,
            //    security through obscurity isn't actually security.
            $del_user = $del_user->where('id', \Auth::user()->id)->first();
        }

        if ($del_user) {
            $del_user->delete();
        }

      return redirect('/users');
    }

    /**
     * Allows users to upload documentation to the users document store.
     *
     * @param  Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, User $user)
    {
        // $path = $request->file('document')->store('documents');
        $path = Storage::disk('user')->putFileAs(
            $user->id, $request->file('document'), $request->file('document')->getClientOriginalName()
        );
        return redirect(route('users.show', [$user->id]));
    }
}
