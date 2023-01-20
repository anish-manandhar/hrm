<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class JobOpening extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $table = 'job_openings';
    protected $fillable = [
        'title',
        'total_vacancies',
        'experience',
        'application_deadline',
        'salary',
        'skills',
        'offerings',
        'description',
        'image',
        'designation_id',
        'department_id',
        'division_id',
        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function division()
    {
        return $this->hasOne(Division::class, 'id', 'division_id');
    }

    public function designation()
    {
        return $this->hasOne(Designation::class, 'id', 'designation_id');
    }
}
