<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'name', 'email', 'password', 'verifyToken'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Ein user kann mehreren Produkten zu geordent werden, benötigt für warenkorb/bestellungen
    /*
    public function products(){
        return $this->hasMany('App\Product');
    }
    */

    /*
     * m
     */
    public function orders(){
        return $this->hasMany('App\Order');
    }

}
