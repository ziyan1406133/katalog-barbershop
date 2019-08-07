<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function barbershop(){
        return $this->hasMany('App\Barbershop');
    }
}
