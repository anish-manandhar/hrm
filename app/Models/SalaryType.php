<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryType extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'salary_types';
    protected $fillable = [
        'title',
        'type',
        'per_amt',
        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];
}
