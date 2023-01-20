<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employees';
    protected $fillable = [
        'alt_email',
        'alt_phone',
        'otp',
        'otp_created_at',
        'dob',
        'joining_date',
        'gender',
        'pan',
        'citizenship',

        'uploaded_documents',
        'permanent_address',
        'temporary_address',
        'permanent_address_2',
        'temporary_address_2',
        'permanent_city',
        'temporary_city',
        'permanent_country',
        'temporary_country',
        'permanent_postal_code',
        'temporary_postal_code',
        'disabling_remarks',
        'contract_start_date',
        'contract_end_date',
        'contract_files',
        'salary',
        'salary_period',
        'duty_type',
        'marital_status',
        'blood_group',
        'father_name',
        'mother_name',
        'father_contact',
        'mother_contact',

        'organization_name',
        'organization_contact',
        'organization_address',
        'hr_name',
        'hr_contact',
        'organization_document',

        'emergency_contact_person_name',
        'emergency_contact_person_contact',
        'emergency_contact_person_address',
        'emergency_contact_person_relation',

        'ex_employee',
        'notice_period',
        'notice_period_remarks',
        'notice_period_start_date',
        'notice_period_end_date',

        'bank_name',
        'account_holder_name',
        'bank_branch',
        'bank_account_no',
        'bank_remarks',

        'college_name',
        'college_address',
        'completion_year',
        'highest_degree_name',
        'degree_document',

        'user_id',
        'designation_id',
        'department_id',
        'division_id',

        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];

    public function getDesignation()
    {
        return $this->hasOne(Designation::class, 'id', 'designation_id');
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function getDivison()
    {
        return $this->hasOne(Division::class, 'id', 'division_id');
    }
}
