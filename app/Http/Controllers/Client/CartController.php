<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductManage;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function AddCart(Request $request){

        $product = ProductManage::where('id',$request->ProductId)->first();
        Cart::add(['id'=>$request->ProductId,'name'=>$request->pro_name,'price'=>$request->price,'qty'=>$request->qty,'weight' => 550,'options' => ['image'=>$product->image]]);
        return redirect('/shopping-cart-page');
    }

    public function ShoppingCartAjaxPage(){
        $data['cart'] = Cart::content();
        $data['total'] = Cart::subtotal();
        $data['count'] = Cart::count();
        return view('ClientSite.Card_Ajax.card',$data);
    }


    public function ShoppingCartDecrement(Request $request){


        $card = Cart::get($request->rowId);
        $newcard = $card->qty;


        if($newcard>1){
            $towin = $newcard-=1;
            Cart::update($request->rowId,$towin);
        }

         return redirect('shopping-ajax-cart-page');
    }

    public function ShoppingCartIncrement(Request $request){

        $card = Cart::get($request->rowId);
        $newcard = $card->qty;
        $towin = $newcard+=1;
        Cart::update($request->rowId,$towin);

        return redirect('shopping-ajax-cart-page');
    }

    public function ShoppingCartRemove(Request $request){

        Cart::remove($request->rowId);
        return redirect('shopping-ajax-cart-page');
    }
}
