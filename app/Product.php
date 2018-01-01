<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //Table Name
    protected $table = 'products';

    //Primary Key
    public $primaryKey = 'id';

    //Timestamps
    public $timestamps = true; 

    //Um verbindung zu User herzustellen benötigt beim Warenkorb
    /*
    public function user(){
    	return $this->belongsTo('App/User');
    }
    */

}
