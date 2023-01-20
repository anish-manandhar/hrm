<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'divisions';

    protected $fillable = [
        'title',
        'status',
        'department_id',
        'created_by',
        'updated_by',
    ];

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
}
