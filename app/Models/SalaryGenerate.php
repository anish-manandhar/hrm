<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SalaryGenerate extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $table = 'salary_generates';
    protected $fillable = [
        'start_date',
        'end_date',
        'remarks',
        'employee_id',
        'created_by',
        'updated_by',
        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];

    public function employee()
    {
        return $this->hasOne(Department::class, 'id', 'employee_id');
    }
}
