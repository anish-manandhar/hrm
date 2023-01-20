<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Holiday extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = 'holidays';

    protected $fillable = [
        'title',
        'from',
        'to',
        'repeat',
        'days',
        'department',
        'created_by',
        'updated_by',
    ];
    protected $dates = [
        'deleted_at'
    ];
    protected $casts = [
        'department' => 'json'
    ];

    public function routeNotificationForSlack($notification)
    {
        return 'https://hooks.slack.com/services/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';
    }
}
