<?php

use Illuminate\Database\Seeder;
use App\SystemRole;

class SystemRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SystemRole::create([
            'user_id' => 1,
            'role_id' => 1,
        ]);
    }
}
