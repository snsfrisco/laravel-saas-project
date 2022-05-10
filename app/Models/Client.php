<?php

namespace App\Models;

use App\ConcreteClasses\Clients\IClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model implements IClient
{
    use HasFactory;

    protected $guarded=[];

    public function roles()
    {
        return $this->morphMany(Role::class, 'roleable');
    }

    public function members()
    {
        return $this->hasManyThrough(
            Member::class,
            Branch::class,
        );
    }

    public function getMembers()
    {
        return $this->members;
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function getCustomers()
    {
        return $this->customers;
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
    public function regions()
    {
        return $this->hasMany(Region::class);
    }
    public function zones()
    {
        return $this->hasMany(Zone::class);
    }

    public function getInitialsAttribute(){
        $name_array = explode(' ',trim($this->name));
        $initials = '';
        foreach ($name_array as $key => $value) {
            $initials .= $value[0];
        }
        // $firstWord = $name_array[0];
        // $lastWord = $name_array[count($name_array)-1];

        // return $firstWord[0]."".$lastWord[0];

        return $initials;
    }


}
