<?php

use Illuminate\Database\Seeder;
use App\Employer;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employer::create([
            'user_id' => 3,
            'company' => 'SCU Dev',
            'address' => 'SCU',
            'domain' => 'scu.edu.au'
        ]);
    }
}
