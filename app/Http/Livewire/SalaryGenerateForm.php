<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use App\Models\SalarySetup;
use App\Models\SalaryType;
use App\Models\User;
use Livewire\Component;

class SalaryGenerateForm extends Component
{
    public int $employee_id = 0;
    public $start_date, $end_date;

    public function render()
    {
        $salary_users = User::where('user_type', 'Employee')->pluck('name', 'id');
        $salary_details = [];
        $days = 0;
        if ($this->employee_id && $this->start_date && $this->end_date) {
            $start = \DateTime::createFromFormat('Y-m-d', $this->start_date);
            $end = \DateTime::createFromFormat('Y-m-d', $this->end_date);
            $interval = $start->diff($end);
            $days = $interval->format('%a');
            $setup = SalarySetup::where('employee_id', $this->employee_id)->first();
            $salary_details[] = [
                'title' => 'Basic Pay',
                'wage' => (Employee::where('user_id', $this->employee_id)->first()->salary / get_setting('days_in_month_for_salary') * $days),
                'monthly_wage' => Employee::where('user_id', $this->employee_id)->first()->salary,
            ];
            if (json_decode($setup->salary_details)) {
                foreach (json_decode($setup->salary_details) as $id => $wage) {
                    $salary_details[] = [
                        'title' => SalaryType::findOrFail($id)->title,
                        'wage' => ($wage / get_setting('days_in_month_for_salary') * $days),
                        'monthly_wage' => $wage,
                    ];
                }
            }
        }
        $data = [
            'all_employees' => $salary_users,
            'salary_details' => $salary_details,
            'days' => $days,
        ];
        return view('livewire.salary-generate-form', $data);
    }
}
