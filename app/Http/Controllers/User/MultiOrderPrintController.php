<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client\OrderDetail;
use App\Models\Client\Order;
use PDF;

class MultiOrderPrintController extends Controller
{
    public function UserMultiOrderPront(Request $request){

        $data['Order'] = Order::whereIn('id',$request->prints)->get();
//        dd($data['Order']);
        $pdf =PDF::loadView('UserDashboard/OrderManage/pdf/order_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');

    }
}
