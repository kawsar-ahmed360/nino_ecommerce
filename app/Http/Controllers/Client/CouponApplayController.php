<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Admin\CouponManage;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;

class CouponApplayController extends Controller
{
    public function CouponApplay(Request $request){

        $match = CouponManage::where('status','1')->where('coupon_name',$request->coupon)->first();

        if($match){

            Session::put('coupon',[
                'name'=>$match->coupon_name,
                'discount'=>$match->amount,
                // 'amount'=>str_replace(',','',Cart::Subtotal())-(int)$check->discount,
            ]);


            $noti = array(
                'message'=>'Coupon SuccessFully Applayed',
                'alert-type'=>'success'
            );

            return redirect()->back()->with($noti);

        }else{

            $noti = array(
                'message'=>'Coupon Not Found!!!',
                'alert-type'=>'error'
            );

            return redirect()->back()->with($noti);
        }


    }
}
