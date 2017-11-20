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
            'Fname' => 'Hayden',
            'Lname' => 'Jones',
            'DOB' => '2017-12-31',
            'address' => '',
            'email' => 'hjone72@gmail.com',
            'password' => bcrypt('P@ssw0rd'),
        ]);
    }
}
