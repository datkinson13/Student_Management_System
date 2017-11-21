<?php

use Illuminate\Database\Seeder;
use App\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'user_id' => 2,
            'employer_id' => 1
        ]);

        Employee::create([
            'user_id' => 4,
            'employer_id' => 1
        ]);
    }
}
