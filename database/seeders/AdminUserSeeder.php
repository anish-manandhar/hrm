<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'super@hrm.com',
            'user_type' => 'Super',
            'phone' => '1234567890',
            'password' => Hash::make('#Machine786'),
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);
        $user = User::create([
            'name' => 'Employee',
            'email' => 'employee@hrm.com',
            'user_type' => 'Employee',
            'phone' => '1234567891',
            'password' => Hash::make('#Machine786'),
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);
        Employee::create([
            'user_id' => $user->id
        ]);
    }
}
