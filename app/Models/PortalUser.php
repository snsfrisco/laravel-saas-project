<?php

namespace App\Models;

use App\Traits\GeneralUserDetails;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class PortalUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, GeneralUserDetails;

    protected $guard = 'portal_user';

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime:m/d/Y h:i A',
        'updated_at' => 'datetime:m/d/Y h:i A',
        'email_verified_at' => 'datetime',
    ];

    public function company_users()
    {
        return $this->morphMany(CompanyUser::class, 'created_by');
    }

}
