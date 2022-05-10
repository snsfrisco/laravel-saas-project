<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime:m/d/Y h:i A',
        'updated_at' => 'datetime:m/d/Y h:i A'
    ];

    public function roles()
    {
        return $this->morphMany(Role::class, 'roleable');
    }

    public function created_by_user()
    {
        return $this->belongsTo(PortalUser::class, 'created_by');
    }
}
