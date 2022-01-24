<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart 
{
    public $items = null; //Group of one products
    public $totalQty = 0; //for total Quantity of products
    public $totalprice = 0; //for total price of products
   
    public function __Construct($oldCart){
        if ($oldCart) {
            # code...
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalprice = $oldCart->totalprice;
        }else{
            $this->items = null;
        }
    }

    /*Add Products to cart */
    public function add($item, $id){
        $storedItem = ['id' => $item->id ,'pro_name' => $item->pro_name, 'pro_price' => $item->pro_price,'qty' => 0,  'item' => $item];
        if($this->items) {
            if (array_key_exists($id, $this->items)) {
                # code...
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['pro_price'] = $item->pro_price * $storedItem['qty'];
        $storedItem['pro_name'] = $item->pro_name ;
        $storedItem['id'] = $item->id;
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalprice += $item->pro_price;
    }

    /* Delete One by One */
    public function deleteOne($id){

        $this->items[$id]['qty']--;
        $this->items[$id]['pro_price'] -= $this->items[$id]['item']['pro_price'];
        $this->totalQty--;
        $this->totalprice--;
        $this->totalprice -= $this->items[$id]['item']['pro_price'];

    }

    /* Remove Itme From cart */
    public function removeItem($id){
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalprice -= $this->items[$id]['item']['pro_price'];
        unset($this->items[$id]);
    }


}
