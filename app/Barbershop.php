<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barbershop extends Model
{
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function hairstyles(){
        return $this->hasMany('App\Hairstyle')->orderBy('kategori', 'desc');
    }
    
    public function province() {
        return $this->belongsTo('App\Province');
    }
    
    public function regency() {
        return $this->belongsTo('App\Regency');
    }
    
    public function district() {
        return $this->belongsTo('App\District');
    }
}
