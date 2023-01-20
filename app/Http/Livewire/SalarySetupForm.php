<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use App\Models\Leave;
use App\Models\SalarySetup;
use App\Models\SalaryType;
use App\Models\User;
use Livewire\Component;

class SalarySetupForm extends Component
{
    public int $employee_id = 0, $basic_pay = 0, $total_payable = 0;
    public $wages = [];

    public function render()
    {
        $this->total_payable = 0;
        if ($this->employee_id) {
            $this->basic_pay = Employee::where('user_id', $this->employee_id)->first()->salary;
        }
        if ($this->basic_pay)
            $this->total_payable = $this->basic_pay;
        if ($this->wages) {
            foreach ($this->wages as $key => $wage) {
                if ($wage) {
                    $salary = SalaryType::findOrFail($key);
                    if ($salary->per_amt == 'Percentage') {
                        $this->total_payable = $this->total_payable + ($wage * $this->basic_pay / 100);
                    } else {
                        $this->total_payable = $this->total_payable + $wage;
                    }
                }
            }
        }
        $salary_users = User::where('user_type', 'Employee')->whereNotIn('id', SalarySetup::pluck('employee_id')->toArray())->pluck('name', 'id');
        $data = [

            'all_employees' => $salary_users
        ];
        return view('livewire.salary-setup-form', $data);
    }
}
