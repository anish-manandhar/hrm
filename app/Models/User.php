<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = [
        'prefix_id',
        'name',
        'email',
        'phone',
        'password',
        'status',
        'image',
        'user_type',
        'created_by',
        'updated_by',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
    ];

    public function routeNotificationForSlack($notification)
    {
        return 'https://hooks.slack.com/services/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';
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id', 'id');
    }  

    public function salary()
    {
        return $this->hasOne(SalarySetup::class, 'employee_id', 'id');
    }

//     public function attendance()
//     {
//         return $this->hasOne(Attendance::class, 'user_id', 'id');
//     }
}
