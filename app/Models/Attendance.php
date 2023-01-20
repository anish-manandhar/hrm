<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'attendances';

    protected $fillable = [
        'date',
        'user_id',
        'created_by',
        'updated_by',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function checkInCheckOuts()
    {
        return $this->hasMany(CheckInCheckOut::class, 'attendance_id', 'id');
    }

    public function scopeCreateNew()
    {
        if($this->checkInCheckOuts->whereNull('check_out'))
            return true;
        else
            return false;
    }
}
