<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hairstyle extends Model
{
    public function barbershop(){
        return $this->belongsTo('App\Barbershop');
    }
}
