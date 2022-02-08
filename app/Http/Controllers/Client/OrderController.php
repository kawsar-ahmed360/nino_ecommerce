<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\BillingShipping;
use App\Models\Client\CustomerRegistration;
use App\Models\Client\Order;
use App\Models\Client\OrderDetail;
use App\Models\Client\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PDF;

class OrderController extends Controller
{
    public function customerOrderList(){

        if (Session::has('customer_id')) {
        $data['customer_info'] = CustomerRegistration::where('id',Session::get('customer_id'))->first();
        $data['order'] = Order::where('user_id',Session::get('customer_id'))->OrderBy('created_at','desc')->get();


        return view('ClientSite.CustomerDashboard.OrderList.order_list',$data);

        }else{
            return redirect()->route('MainIndex');
        }
    }

    public function customerOrderDetails($id){
        $id = base64_decode($id);
        $data['customer_info'] = CustomerRegistration::where('id',Session::get('customer_id'))->first();
        $data['order_details'] = OrderDetail::where('order_id',$id)->get();
        return view('ClientSite.CustomerDashboard.OrderList.order_details',$data);
    }

    public function customerOrderDetailsPdf($id){
        $id = base64_decode($id);
        $data['customer_info'] = CustomerRegistration::where('id',Session::get('customer_id'))->first();
        $data['shipping'] = BillingShipping::where('user_id',Session::get('customer_id'))->first();
        $data['order_details'] = OrderDetail::where('order_id',$id)->get();
        $pdf =PDF::loadView('ClientSite/CustomerDashboard/OrderList/pdf/order_details_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function customerWishList(){

        if (Session::has('customer_id')) {
            $data['customer_info'] = CustomerRegistration::where('id',Session::get('customer_id'))->first();
            $data['wishlist'] = Wishlist::where('user_id',Session::get('customer_id'))->where('session_id',Session::getId())->OrderBy('id','desc')->get();

            return view('ClientSite.CustomerDashboard.Wishlist.all_list',$data);
        }else{
            return redirect()->route('MainIndex');
        }
    }

    public function customerWishDelete($id){
        $id = base64_decode($id);
        if (Session::has('customer_id')) {
            Wishlist::where('id',$id)->where('user_id',Session::get('customer_id'))->where('session_id',Session::getId())->delete();
            $noti = array(
                'message'=>'succesfully deleted',
                'alert-type'=>'success'
            );

            return redirect()->back()->with($noti);
        }

    }
}
