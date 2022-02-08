<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\CustomerOrderApprove;
use App\Mail\CustomerOrderCancle;
use App\Mail\CustomerOrderCancleShiped;
use App\Mail\CustomerShippingApprove;
use App\Models\Admin;
use App\Models\Admin\Setting;
use App\Models\Client\CustomerRegistration;
use App\Models\Client\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Mail;
use Mail;

class OrderManageAdmin extends Controller
{

    public function AllCustomerApproveAjax(){

        $data['order']=Order::OrderBy('id','desc')->get();
        return view('AdminDashboard.OrderManage.OrderListAjax.order',$data);

    }


    public function AllCustomerOrder(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['order']=Order::OrderBy('id','desc')->get();
        return view('AdminDashboard.OrderManage.AllList',$data);
    }

    public function AllCustomerApprove(Request $request){

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

        return $this->AllCustomerApproveAjax();
    }

    public function AllCustomerNotApprove(Request $request){

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

        return $this->AllCustomerApproveAjax();
    }

    //......................Shipment Section.......................
    public function AllCustomerShippingApprove(Request $request){

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

        return $this->AllCustomerApproveAjax();
    }

    public function AllCustomerShippingNotApprove(Request $request){

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

        return $this->AllCustomerApproveAjax();
    }

    public function AllCustomerOrderComplete(Request $request){

        $approve = Order::where('id',$request->id)->first();
        $approve->order_complete=2;
        $approve->save();

        return $this->AllCustomerApproveAjax();
    }

    //...................All Panding Order..............

    public function AllCustomerPandingAjax(){
        $data['order']=Order::OrderBy('id','desc')->where('status','1')->Orwhere('shipping_status','1')->Orwhere('order_complete','1')->get();
        return view('AdminDashboard.OrderManage.OrderListAjax.panding_order',$data);
    }

    public function AllCustomerPandingOrder(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['order']=Order::OrderBy('id','desc')->where('status','1')->Orwhere('shipping_status','1')->Orwhere('order_complete','1')->get();
        return view('AdminDashboard.OrderManage.PandingOrder',$data);
    }


    public function AllCustomerPandingApprove(Request $request){

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

        return $this->AllCustomerPandingAjax();
    }

    public function AllCustomerPandingNotApprove(Request $request){

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

        return $this->AllCustomerPandingAjax();
    }

    //......................Shipment Section.......................
    public function AllCustomerPandingShippingApprove(Request $request){

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

        return $this->AllCustomerPandingAjax();
    }

    public function AllCustomerPandingShippingNotApprove(Request $request){

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

        return $this->AllCustomerPandingAjax();
    }

    public function AllCustomerPandingOrderComplete(Request $request){

        $approve = Order::where('id',$request->id)->first();
        $approve->order_complete=2;
        $approve->save();

        return $this->AllCustomerPandingAjax();
    }

    //.....................Order Complete List................

    public function AllCompleteOrderList(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['order']=Order::OrderBy('id','desc')->where('status','2')->where('shipping_status','2')->where('order_complete','2')->get();
        return view('AdminDashboard.OrderManage.CompleteOrderList',$data);
    }

    
       public function AllCustomerOrderDetails($id){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['order'] = Order::with(['order_details','customer','payments'])->where('id',$id)->first();
        
        // dd($data['order']);


        return view('AdminDashboard.OrderManage.Order_Details',$data);
    }


}
