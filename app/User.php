<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function barbershops(){
        return $this->hasMany('App\Barbershop')->orderBy('name', 'desc');
    }

    public function verified(){
        return $this->hasMany('App\Barbershop')->where('status', 'Terverifikasi')->orderBy('name', 'desc');
    }

    public function ditolak(){
        return $this->hasMany('App\Barbershop')->where('status', 'Ditolak')->orderBy('updated_at', 'desc');
    }
    
}
