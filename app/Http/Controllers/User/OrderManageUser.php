<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Setting;
use App\Models\Client\CustomerRegistration;
use App\Models\Client\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\CustomerOrderApprove;
use App\Mail\CustomerOrderCancle;
use App\Mail\CustomerOrderCancleShiped;
use App\Mail\CustomerShippingApprove;
use Mail;


class OrderManageUser extends Controller
{
    public function UserAllCustomerApproveAjax(){

        $data['order']=Order::OrderBy('id','desc')->get();
        return view('UserDashboard.OrderManage.OrderListAjax.order',$data);

    }


    public function UserAllCustomerOrder(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['order']=Order::OrderBy('id','desc')->get();
        return view('UserDashboard.OrderManage.AllList',$data);
    }

    public function UserAllCustomerApprove(Request $request){

        $approve = Order::where('id',$request->id)->first();
        $approve->status=2;
        $approve->save();
        $customer = CustomerRegistration::where('id',$approve->user_id)->first();

        $data = array(
            'ema'      =>  $customer->email,
            'nam'   =>   $customer->name,
            'orderid'   =>   $approve->orderId,
        );
        Mail::to($data['ema'])->send(new CustomerOrderApprove($data));

        return $this->UserAllCustomerApproveAjax();
    }

    public function UserAllCustomerNotApprove(Request $request){

        $approve = Order::where('id',$request->id)->first();
        $approve->status=1;
        $approve->save();
        $customer = CustomerRegistration::where('id',$approve->user_id)->first();
        $data = array(
            'ema'      =>  $customer->email,
            'nam'   =>   $customer->name,
            'orderid'   =>   $approve->orderId,
        );
        Mail::to($data['ema'])->send(new CustomerOrderCancle($data));

        return $this->UserAllCustomerApproveAjax();
    }

    //......................Shipment Section.......................
    public function UserAllCustomerShippingApprove(Request $request){

        $approve = Order::where('id',$request->id)->first();
        $approve->shipping_status=2;
        $approve->save();
        $customer = CustomerRegistration::where('id',$approve->user_id)->first();
        $data = array(
            'ema'      =>  $customer->email,
            'nam'   =>   $customer->name,
            'orderid'   =>   $approve->orderId,
        );
        Mail::to($data['ema'])->send(new CustomerShippingApprove($data));

        return $this->UserAllCustomerApproveAjax();
    }

    public function UserAllCustomerShippingNotApprove(Request $request){

        $approve = Order::where('id',$request->id)->first();
        $approve->shipping_status=1;
        $approve->save();

        $customer = CustomerRegistration::where('id',$approve->user_id)->first();
        $data = array(
            'ema'      =>  $customer->email,
            'nam'   =>   $customer->name,
            'orderid'   =>   $approve->orderId,
        );
        Mail::to($data['ema'])->send(new CustomerOrderCancleShiped($data));

        return $this->UserAllCustomerApproveAjax();
    }

    public function UserAllCustomerOrderComplete(Request $request){

        $approve = Order::where('id',$request->id)->first();
        $approve->order_complete=2;
        $approve->save();

        return $this->UserAllCustomerApproveAjax();
    }

    //...................All Panding Order..............

    public function UserAllCustomerPandingAjax(){

        $data['order']=Order::OrderBy('id','desc')->where('status','1')->Orwhere('shipping_status','1')->Orwhere('order_complete','1')->get();
        return view('UserDashboard.OrderManage.OrderListAjax.panding_order',$data);
    }

    public function UserAllCustomerPandingOrder(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['order']=Order::OrderBy('id','desc')->where('status','1')->Orwhere('shipping_status','1')->Orwhere('order_complete','1')->get();
        return view('UserDashboard.OrderManage.PandingOrder',$data);
    }


    public function UserAllCustomerPandingApprove(Request $request){

        $approve = Order::where('id',$request->id)->first();
        $approve->status=2;
        $approve->save();
        $customer = CustomerRegistration::where('id',$approve->user_id)->first();

        $data = array(
            'ema'      =>  $customer->email,
            'nam'   =>   $customer->name,
            'orderid'   =>   $approve->orderId,
        );
        Mail::to($data['ema'])->send(new CustomerOrderApprove($data));

        return $this->UserAllCustomerPandingAjax();
    }

    public function UserAllCustomerPandingNotApprove(Request $request){

        $approve = Order::where('id',$request->id)->first();
        $approve->status=1;
        $approve->save();
        $customer = CustomerRegistration::where('id',$approve->user_id)->first();
        $data = array(
            'ema'      =>  $customer->email,
            'nam'   =>   $customer->name,
            'orderid'   =>   $approve->orderId,
        );
        Mail::to($data['ema'])->send(new CustomerOrderCancle($data));

        return $this->UserAllCustomerPandingAjax();
    }

    //......................Shipment Section.......................
    public function UserAllCustomerPandingShippingApprove(Request $request){

        $approve = Order::where('id',$request->id)->first();
        $approve->shipping_status=2;
        $approve->save();
        $customer = CustomerRegistration::where('id',$approve->user_id)->first();
        $data = array(
            'ema'      =>  $customer->email,
            'nam'   =>   $customer->name,
            'orderid'   =>   $approve->orderId,
        );
        Mail::to($data['ema'])->send(new CustomerShippingApprove($data));

        return $this->UserAllCustomerPandingAjax();
    }

    public function UserAllCustomerPandingShippingNotApprove(Request $request){

        $approve = Order::where('id',$request->id)->first();
        $approve->shipping_status=1;
        $approve->save();

        $customer = CustomerRegistration::where('id',$approve->user_id)->first();
        $data = array(
            'ema'      =>  $customer->email,
            'nam'   =>   $customer->name,
            'orderid'   =>   $approve->orderId,
        );
        Mail::to($data['ema'])->send(new CustomerOrderCancleShiped($data));

        return $this->UserAllCustomerPandingAjax();
    }

    public function UserAllCustomerPandingOrderComplete(Request $request){

        $approve = Order::where('id',$request->id)->first();
        $approve->order_complete=2;
        $approve->save();

        return $this->UserAllCustomerPandingAjax();
    }

    //.....................Order Complete List................

    public function UserAllCompleteOrderList(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['order']=Order::OrderBy('id','desc')->where('status','2')->where('shipping_status','2')->where('order_complete','2')->get();
        return view('UserDashboard.OrderManage.CompleteOrderList',$data);
    }
    
    
    
    public function UserAllCustomerOrderDetails($id){
       $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['order'] = Order::with(['order_details','customer','payments'])->where('id',$id)->first();
        

        return view('UserDashboard.OrderManage.Order_Details',$data);
    }
}
