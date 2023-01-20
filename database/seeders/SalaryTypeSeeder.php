<?php

namespace Database\Seeders;

use App\Models\SalaryType;
use Illuminate\Database\Seeder;

class SalaryTypeSeeder extends Seeder
{
    public function run()
    {
        SalaryType::create([
            'title' => 'Bonus Pay',
            'type' => 'Add',
        ]);
        SalaryType::create([
            'title' => 'Overtime Wages',
            'type' => 'Add',
        ]);
        SalaryType::create([
            'title' => 'Tax',
            'per_amt' => 'Percentage',
            'type' => 'Deduct',
        ]);
    }
}
