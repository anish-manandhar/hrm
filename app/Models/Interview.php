<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interview extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'interviews';

    protected $fillable = [
        'candidate_id',
        'interviewer_id',
        'date_time',
        'selected',
        'recommendation',
        'remarks',
        'created_by',
        'updated_by',
    ];
    
    protected $dates = ['deleted_at'];

    public function getCandidate()
    {
        return $this->hasOne(Candidate::class, 'id', 'candidate_id');
    }

    public function getInterviewer()
    {
        return $this->hasOne(User::class, 'id', 'interviewer_id');
    }
}