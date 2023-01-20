<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    public function run()
    {
        LeaveType::create([
            'title' => 'Sick Leave',
            'days' => 1,
        ]);
    }
}
