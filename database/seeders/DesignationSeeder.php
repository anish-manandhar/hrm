<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    public function run()
    {
        Designation::create([
            'title' => 'CEO',
            'working' => 1,
            'rank' => 1,
        ]);
        Designation::create([
            'title' => 'CTO',
            'working' => 1,
            'rank' => 2,
        ]);
        Designation::create([
            'title' => 'COO',
            'working' => 1,
            'rank' => 3,
        ]);
    }
}
