<?php

namespace App;


class Cart
{
    public $items=null; //Group(Item with all the variabls of Products
    //total Quantity
    public $totalQty = 0;
    public $totalPrice =0;

    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id){
        //one Group/Item as assotiatives Array
        $storedItem = ['qty'=>0, 'price'=>$item->price, 'item'=>$item];

        //checking if item already exists
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
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

}