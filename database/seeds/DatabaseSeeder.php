<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(\RolesSeeder::class);
        $this->call(\UserSeeder::class);
        $this->call(\SystemRoleSeeder::class);
        $this->call(\CourseSeeder::class);
    }
}
