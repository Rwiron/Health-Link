<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'Patient']);
        Role::create(['name' => 'Doctor']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Super Admin']);
    }
}
