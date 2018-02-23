<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 09.02.2018
 * Time: 11:34
 */
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
}
