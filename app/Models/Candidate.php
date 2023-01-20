<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'candidates';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'alt_email',
        'alt_phone',
        'dob',
        'gender',
        'pan',
        'citizenship',
        'street_address',
        'shortlisted',
        'salary_expectation',
        'salary_period',
        'duty_type',
        'marital_status',
        'organization_name',
        'organization_contact',
        'organization_address',
        'hr_name',
        'hr_contact',
        'job_opening_id',
        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];

    public function jobOpening()
    {
        return $this->hasOne(JobOpening::class, 'id', 'job_opening_id');
    }
}
