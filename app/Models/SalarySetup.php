<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalarySetup extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'salary_setups';
    protected $fillable = [
        'employee_id',
        'salary_details',
        'gross_amount',
        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];


    public function employee()
    {
        return $this->hasOne(User::class, 'id', 'employeeeb_id');
    }

}
