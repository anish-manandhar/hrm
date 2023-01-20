<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        Department::create([
            'title' => 'PHP Dept',
        ]);
        Department::create([
            'title' => 'Django Dept',
        ]);
    }
}
