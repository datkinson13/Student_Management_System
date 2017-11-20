<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Employer;
use App\Employee;

class RegisterController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'Fname'    => 'required|string|max:255',
            'Lname'    => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'phone'    => 'nullable|digits:10',
            'mobile'   => 'nullable|digits:10',
            'DOB'      => 'nullable|date',
            'address'  => 'nullable|string',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $email = preg_replace('/.+@/', '', strtolower($data['email']));
        $employer = Employer::where('domain', $email)->get();

        $user = User::create([
            'Fname'    => $data['Fname'],
            'Lname'    => $data['Lname'],
            'email'    => $data['email'],
            'phone'    => $data['phone'],
            'mobile'   => $data['mobile'],
            'DOB'      => $data['DOB'],
            'address'  => $data['address'],
            'password' => bcrypt($data['password']),
        ]);

        if (count($employer) == 1) {
            Employee::create(['user_id' => $user->id, 'employer_id' => $employer->first()->id]);
        }

        return $user;
    }
}
