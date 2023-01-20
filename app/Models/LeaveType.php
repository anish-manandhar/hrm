<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveType extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'leave_types';
    protected $fillable = [
        'title',
        'days',
        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];
}
