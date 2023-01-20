<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leave extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'leaves';
    protected $fillable = [
        'start_date',
        'end_date',
        'days',
        'remarks',
        'employee_id',
        'leave_type_id',
        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];

    public function employee()
    {
        return $this->hasOne(User::class, 'id', 'employee_id');
    }

    public function leaveType()
    {
        return $this->hasOne(LeaveType::class, 'id', 'leave_type_id');
    }

    public function approvedBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

}
