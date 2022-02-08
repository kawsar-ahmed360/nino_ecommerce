<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\BillingShipping;
use App\Models\Client\CustomerRegistration;
use App\Models\Client\Order;
use App\Models\Client\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SuccessPageController extends Controller
{
    public function SuccessPage(){

        $data['order'] = Order::where('user_id',Session::get('user_id'))->first();
        $data['CustomerInfo'] = CustomerRegistration::where('id',$data['order']->user_id)->first();
        $data['shipping'] = BillingShipping::where('id',$data['order']->billing_id)->first();
        $data['order_details'] = OrderDetail::where('order_id',$data['order']->id)->get();
        return view('ClientSite.single_page.success',$data);
    }
}
