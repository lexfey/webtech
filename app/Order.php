<?php
/*
 * @created by Demi 14.02.2018
 *
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /*
     * Assigns one Order to one User
     *
     * @created by Demi
     * @return belogsTo
     */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
