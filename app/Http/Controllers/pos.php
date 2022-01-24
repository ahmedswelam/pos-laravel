<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\product;
use App\Models\cart;

class pos extends Controller
{
    //

    public function home(){
        return view('homepage');
    }



    /* Add To Cart Function */
    public function AddToCart(Request $request, $id){
        

        $product = product::find($id);

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart    = new Cart($oldCart);
        $cart->add($product, $product->id);
        
        $request->session()->put('cart', $cart);
        return redirect(url('home/cart'));

    }

    /* My Cart Products Function */
    public function myCart(){
       
        /* Products Fetch */
        $data = product::get();  // product = table name
        /*return view('home',['data' => $data]);*/

        /* Cart Logic */
        if (!Session::has('cart')) {
            # code...
            return view('home', ['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        //return view('home');
        return view('home',['data' => $data],['products' => $cart->items,
        'totalprice' => $cart->totalprice,'totalQty' => $cart->totalQty]);  
    }

    /* Delete One by One Function */
    public function deleteOne($id){

    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart    = new Cart($oldCart);
    $cart->deleteOne($id);

    Session::put('cart', $cart);
    return redirect(url('home/cart'));
    }

    /* Remove Item Function */
    public function removeItem($id){

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart    = new Cart($oldCart);
        $cart->removeItem($id);

        Session::put('cart', $cart);
        return redirect(url('home/cart'));

    }

}
