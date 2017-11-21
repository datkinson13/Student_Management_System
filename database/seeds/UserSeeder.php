<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'Fname' => 'Admin',
            'Lname' => 'Istrator',
            'DOB' => '2017-12-31',
            'address' => 'Administrator',
            'email' => 'admin@scu.edu.au',
            'password' => bcrypt('P@ssw0rd'),
        ]);

        User::create([
            'Fname' => 'Hayden',
            'Lname' => 'Jones',
            'DOB' => '2017-12-31',
            'address' => 'Employee',
            'email' => 'hjone72@gmail.com',
            'password' => bcrypt('P@ssw0rd'),
        ]);

        User::create([
            'Fname' => 'Phil',
            'Lname' => 'Hardstaff',
            'DOB' => '1990-12-06',
            'address' => 'Employer',
            'email' => 'phil@offonit.com',
            'password' => bcrypt('P@ssw0rd'),
        ]);

        User::create([
            'Fname' => 'Dylan',
            'Lname' => 'Atkinson',
            'DOB' => '2017-11-17',
            'address' => 'Employee',
            'email' => 'dylan.atkinson13@gmail.com',
            'password' => bcrypt('P@ssw0rd'),
        ]);

        User::create([
            'Fname' => 'Super',
            'Lname' => 'Visor',
            'DOB' => '2017-11-17',
            'address' => 'Individual Account',
            'email' => 'supervisor@scu.edu.au',
            'password' => bcrypt('P@ssw0rd'),
        ]);
    }
}
