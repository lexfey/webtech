<?php

/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 09.02.2018
 * Time: 11:34
 */

namespace App;


use Illuminate\Support\Facades\Session;

class Cart
{
    public $items=null; //Group(Item with all the variabls of Products)
    public $totalQty = 0;
    public $totalPrice =0;

    /*
     * Cart constructor
     *
     * takes old cart if given and sets items & Qty & Price
     *
     * @param Cart $oldCart
     * @created by Demi
     * @return void
     */
    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    /*
     * Adds one Item to the shopping Cart
     *
     * Adds Item to shopping Cart and adjust the values of Qty/Price/Sizes
     *
     * @param Product $item the Product that is added
     * @param Int $id of the Product
     * @param String $size of the Product
     *
     *
     * @created by Demi
     * @return void
     */
    public function add($item, $id, $size){
        //one Group/Item as assotiatives Array
        $storedItem = ['qty'=>0, 'price'=>$item->price, 'item'=>$item, 'sizes'=>$size];

        //checking if item already exists
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
                $storedItem['sizes']= $storedItem['sizes'].'|'.$size;
            }
        }

        //increment Quantity
        $storedItem['qty']++;
        //change Price
        $storedItem['price']=$item->price * $storedItem['qty'];
        //add item to items
        $this->items[$id] = $storedItem;

        //Total Values Update
        $this->totalQty++;
        $this->totalPrice += $item->price;

    }

    /*
     * Removes one Product to the shopping Cart
     *
     * Removes on Product (could be multiple Items) from shopping Cart and adjust the values of Qty/Price/Sizes
     *
     * @param Int $id of the Product
     *
     * @created by Demi
     * @return void
     */
    public function remove($id){
        $qty = $this->items[$id]['qty'];
        $price = $this->items[$id]['price'];
        while ($qty!=0){
            $this->totalQty--;
            $qty--;
        }
        $this->totalPrice -= $price;
        unset($this->items[$id]);
    }

    /*
     * Removes one Item from the shopping Cart
     *
     * Removes one Item (specific size) from shopping Cart when it is not available anymore.
     *  Adjust the values of Qty/Price/Sizes
     *
     * @param Int $id of the Product
     * @param String $size of the Product Item to remove
     *
     * @created by Demi
     * @return void
     */
    public function soldOut($id, $size){
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']['price'];
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']['price'];

        if($this->totalQty==0) {
            Session::forget('cart');
        }else{
            if ($this->items[$id]['qty'] == '0') {
                unset($this->items[$id]);
            } else {
                //remove the size from sizes
                $oldSizes = explode('|', $this->items[$id]['sizes']);
                $this->items[$id]['sizes'] = null;
                $removedOne = false;
                foreach ($oldSizes as $s) {
                    if ($size == $s && !$removedOne) {
                        $removedOne = true;
                    } else {
                        if($this->items[$id]['sizes']==null){
                            $this->items[$id]['sizes'] = $s;
                        }else {
                            $this->items[$id]['sizes'] = $this->items[$id]['sizes'] . '|' . $s;
                        }
                    }

                }
            }
        }

    }

    /*
     * Return the Item of specific Id
     *
     * @param Int $id of the Product
     *
     * @created by Demi
     * @return Item
     */
    public function getItem($id){
        return $this->items[$id];
    }

}