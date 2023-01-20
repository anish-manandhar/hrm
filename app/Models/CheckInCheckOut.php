<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckInCheckOut extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'check_in_check_outs';

    protected $fillable = [
        'check_in',
        'check_out',
        'stay_in_seconds',
        'attendance_id',
        'created_by',
        'updated_by',
    ];

    public function attendances()
    {
        return $this->hasOne(Attendance::class, 'id', 'attendance_id');
    }
}
