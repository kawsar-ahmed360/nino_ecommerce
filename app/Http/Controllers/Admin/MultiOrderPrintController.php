<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client\CustomerRegistration;
use App\Models\Client\Order;
use App\Models\Client\OrderDetail;
use Illuminate\Http\Request;
use PDF;
use Mail;
class MultiOrderPrintController extends Controller
{
    public function MultiOrderPront(Request $request){

        if($request->types=='color_print'){
            $data['Order'] = Order::whereIn('id',$request->prints)->get();
            return view('AdminDashboard/OrderManage/pdf/color_prints',$data);
        }else{
            $data['Order'] = Order::whereIn('id',$request->prints)->get();
            $pdf =PDF::loadView('AdminDashboard/OrderManage/pdf/order_pdf',$data,[
                'format' => 'A5-L']);
            $pdf->SetProtection(['copy', 'print','modify','annot-forms','fill-forms','extract','assemble','print-highres'], '', 'pass');
            return $pdf->stream('document.pdf');
        }


    }


}
