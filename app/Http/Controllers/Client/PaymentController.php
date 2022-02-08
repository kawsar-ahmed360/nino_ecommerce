<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Admin\ShippingCharage;
use App\Models\Client\BillingShipping;
use App\Models\Client\CustomerRegistration;
use App\Models\Client\Order;
use App\Models\Client\OrderDetail;
use App\Models\Client\Payment;
use App\Models\Client\TopSallerProduct;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Cart;
use Mail;
use Mpdf\Tag\S;

class PaymentController extends Controller
{


    public function PaymentStore(Request $request){
        
        // return $request->all();


        $request->validate([
            'payment'=>'required',
            'billing_fname'=>'required',
            'billing_lname'=>'required',
            'billing_mobile'=>'required',
            'billing_email'=>'required',
            'billing_country_name'=>'required',
            'billing_state_name'=>'required',
            'billing_city_name'=>'required',
            'billing_zip_code'=>'required',
            'billing_address'=>'required',
            'charge'=>'required'
        ]);



            if(empty($request->payment)){
                $noti = array(
                    'message'=>'please select payment method',
                    'alert-type'=>'error'
                );
                return redirect()->back()->with($noti);
            }


      if(Session::has('customer_id')){
          
          $customer = CustomerRegistration::where('id',Session::get('customer_id'))->first();
          $customer->name = $request->billing_fname.'.'.$request->billing_fname;
          $customer->address = $request->billing_address;
          $customer->email = $request->billing_email;
          $customer->save();
          
        }else{
            
           
            $customer = new CustomerRegistration();
            $customer->email = $request->billing_email;
            $customer->name = $request->billing_fname.'.'.$request->billing_fname;
         
            $customer->mobile = $request->billing_mobile;
            $customer->address = $request->billing_address;
            $customer->save();

            Session::put('gest_customer_id',$customer->id);
        }


        //...................Stact Billing Info Address.............
        $billingStore = new BillingShipping();
        $billingStore->billing_fname = $request->billing_fname;
        if(Session::has('customer_id')){
            $billingStore->user_id = Session::get('customer_id');
        }else{
            $billingStore->user_id = Session::get('gest_customer_id');
        }
        $billingStore->billing_lname = $request->billing_lname;
        $billingStore->billing_mobile = $request->billing_mobile;
        $billingStore->billing_email = $request->billing_email;
        $billingStore->billing_country_name = $request->billing_country_name;
        $billingStore->billing_city_name = $request->billing_city_name;
        $billingStore->billing_zip_code = $request->billing_zip_code;
        $billingStore->billing_state_name = $request->billing_state_name;
        $billingStore->billing_address = $request->billing_address;
        if($request->other_shipment=='other_shipment'){
            $billingStore->other_shipment = $request->other_shipment;
            $billingStore->shipping_fname = $request->shipping_fname;
            $billingStore->shipping_lname = $request->shipping_lname;
            $billingStore->shipping_mobile = $request->shipping_mobile;
            $billingStore->shipping_email = $request->shipping_email;
            $billingStore->shipping_country_name = $request->shipping_country_name;
            $billingStore->shipping_city_name = $request->shipping_city_name;
            $billingStore->shipping_zip_code = $request->shipping_zip_code;
            $billingStore->shipping_state_name = $request->shipping_state_name;
            $billingStore->shipping_address = $request->shipping_address;
        }
        $billingStore->save();
        Session::put('billing_id',$billingStore->id);


        $payment = new Payment();
        //------Jodi Customer Id Thake------------
        if(Session::has('customer_id')){
            $payment->user_id = Session::get('customer_id');
        }else{
            $payment->user_id=$customer->id;
        }
        //------Jodi payment Type Bikash Or CashOnDalivary Id Thake------------
        if ($request->payment=='paypal'){
            $payment->payment = 'paypal';
        }else{
            $payment->payment = 'cash_on_delivery';
        }
        $payment->transaction = $request->transaction;
        $payment->shipping_id = Session::get('billing_id');
        $payment->status ='1';
        $payment->save();

        Session::put('payment_id',$payment->id);
        //...................End Payment Section...............

        //.....................Order Section..............

        $orderid = rand(0000,9999);
        $orderStore =new Order();
        $orderStore->billing_id = Session::get('billing_id');
        $orderStore->payment_id = Session::get('payment_id');
        if(Session::has('customer_id')){
            $orderStore->user_id = Session::get('customer_id');
        }else{
            $orderStore->user_id = $customer->id;
        }

        if($request->shipment_name=='free_shipment'){
//            $shipping_charge = str_replace(',','',$request->charge)-str_replace(',','',$request->total_cart_amount);
//            $shipping_name = ShippingCharage::where('amount',@$shipping_charge)->first()->name;
            $orderStore->orderId = $orderid;
            $orderStore->total_ammount =str_replace(',','',$request->charge);
            $orderStore->shipment_name ='free shipping';
            $orderStore->shipment_amount =0;

        }else{
            $shipping_charge = str_replace(',','',$request->charge)-str_replace(',','',$request->total_cart_amount);
            $shipping_name = ShippingCharage::where('amount',@$shipping_charge)->first()->name;
            $orderStore->orderId = $orderid;
            $orderStore->total_ammount =str_replace(',','',$request->charge);
            $orderStore->shipment_name =$shipping_name;
            $orderStore->shipment_amount =$shipping_charge;
        }

        if(session()->has('coupon')) {
            $orderStore->coupon = session()->get('coupon')['name'];
        }else{

        }
        $orderStore->discount ='0';
        $orderStore->status ='1';
        $orderStore->shipping_status ='1';
        $orderStore->order_complete ='1';
        $orderStore->save();
        Session::put('order_id',$orderStore->id);
        Session::put('user_id',$orderStore->user_id);

        //.......................Start Section.................

        foreach (Cart::content() as $key=>$item) {
            $OrderDetials = new OrderDetail();
            $OrderDetials->shipping_id = Session::get('billing_id');
            $OrderDetials->billing_id = Session::get('billing_id');
            $OrderDetials->order_id = Session::get('order_id');
            $OrderDetials->payment_id = Session::get('payment_id');
            if(Session::has('customer_id')){
                $OrderDetials->user_id = Session::get('customer_id');
            }else{
                $OrderDetials->user_id = Session::get('gest_customer_id');
            }
            $OrderDetials->subtotal =$item->subtotal();
            $OrderDetials->size_id = '0';
            $OrderDetials->color_id = '0';
            $OrderDetials->product_price = $item->price;
            $OrderDetials->product_id = $item->id;
            $OrderDetials->qty = $item->qty;
            $OrderDetials->status = 1;
            $OrderDetials->save();
        }

        //...............Top Seller Product................
        foreach (Cart::content() as $key=>$Cart) {
            $top = new TopSallerProduct();
            if ($top->where('product_id',$Cart->id)->exists()) {
                $top->increment('qty');
            }else{
                $top->product_id = $Cart->id;
                $top->qty = '1';
                $top->save();
            }
        }

        Cart::destroy();

        if(Session::has('customer_id')){
            $order = Order::where('user_id',Session::get('customer_id'))->where('id',Session::get('order_id'))->first();
        }else{
            $order = Order::where('user_id',Session::get('gest_customer_id'))->where('id',Session::get('order_id'))->first();
        }

        //.....................Mail Send.................
        $customer = CustomerRegistration::where('id',$order->user_id)->first();
        $customer_email = CustomerRegistration::where('id',$order->user_id)->first();
        $shipping = BillingShipping::where('id',$order->billing_id)->first();
        $order_details = OrderDetail::where('order_id',$order->id)->get();

        $data =array(
            'email'=>$customer_email->email,
            'order'=>$order,
            'customer'=>$customer,
            'shipping'=>$shipping,
            'order_details'=>$order_details,
        );

        Mail::send('ClientSite/Mail/customer_invoice_mail', $data, function ($message) use($data){
            $message->from('info@erx.life', 'Nino');
            $message->to($data['email'], 'Dear Customer');
            $message->subject('Thank for order');

        });


        Session::forget('billing_id');
        Session::forget('gest_customer_id');
        Session::forget('Total_Amount');
        Session::forget('order_id');
        Session::forget('show_payment_section');
        Session::forget('show_order_section');
        Session::forget('gest_showsession');
        Session::forget('coupon');



        $noti = array(
            'message'=>'Order Successfully Received',
            'alert-type'=>'success'
        );

        if(Session::has('customer_id')){
            return redirect()->route('CustomerDashboard')->with($noti);
        }else{
            return redirect()->route('SuccessPage')->with($noti);
        }



    }



}
