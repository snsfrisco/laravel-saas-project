<?php

namespace App\Models;

use App\ConcreteClasses\Clients\PortalClient;
use App\ConcreteClasses\Clients\SocietyClient;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\GeneralUserDetails;

class ClientUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, GeneralUserDetails;

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

    /**
     * Get the created by user model (client_users or company_users).
     */
    public function created_by()
    {
        return $this->morphTo();
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function getClient()
    {
        $client = $this->client;// dd($client->path_mode);
        return $client->path_mode == 'No' ? $client : (new SocietyClient($client));
    }


}
