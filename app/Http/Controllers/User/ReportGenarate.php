<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Setting;
use App\Models\Client\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class ReportGenarate extends Controller
{


    public function UserReport_Genarator(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        return view('UserDashboard.report.report_genarate',$data);
    }


    public function UserFinal_Report_Genarator(Request $Request){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['s_date'] = $Request->s_date;
        $data['e_date'] = $Request->e_date;
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['Report'] = Order::whereBetween('created_at',[$Request->s_date,$Request->e_date])->where('status','2')->where('shipping_status','2')->where('order_complete','2')->get();

        return view('UserDashboard.report.final_report',$data);
    }


    public function UserPdf_Report_Genarator(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        return view('UserDashboard.report.report_genarate_pdf',$data);
    }



    public function UserPdfFinal_Report_Genarator(Request $Request){

        $data['s_date'] = $Request->s_date;
        $data['e_date'] = $Request->e_date;
        $data['Report'] = Order::whereBetween('created_at',[$Request->s_date,$Request->e_date])->where('status','2')->where('shipping_status','2')->where('order_complete','2')->get();
        $pdf = PDF::loadView('UserDashboard/report/pdf/report_genarte_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
