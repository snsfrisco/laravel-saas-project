<?php

namespace App\Traits;

trait GeneralUserDetails{


    public function getFullNameAttribute()
    {
        $name_arr = [];
        if(!empty($this->first_name)){
            $name_arr[] = $this->first_name;
        }
        if(!empty($this->middle_name)){
            $name_arr[] = $this->middle_name;
        }
        if(!empty($this->last_name)){
            $name_arr[] = $this->last_name;
        }
        return implode(' ', $name_arr);
    }
}
