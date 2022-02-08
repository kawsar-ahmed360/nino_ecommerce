<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Setting;
use App\Models\Client\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class ReportGenarate extends Controller
{
    public function Report_Genarator(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        return view('AdminDashboard.report.report_genarate',$data);
    }

    public function Final_Report_Genarator(Request $Request){

        $data['s_date'] = $Request->s_date;
        $data['e_date'] = $Request->e_date;
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['Report'] = Order::whereBetween('created_at',[$Request->s_date,$Request->e_date])->where('status','2')->where('shipping_status','2')->where('order_complete','2')->get();

        return view('AdminDashboard.report.final_report',$data);
    }

    public function Pdf_Report_Genarator(){

        return view('backend.report.report_genarate_pdf');
    }


    public function PdfFinal_Report_Genarator(Request $Request){

        $data['s_date'] = $Request->s_date;
        $data['e_date'] = $Request->e_date;
        $data['Report'] = Order::whereBetween('created_at',[$Request->s_date,$Request->e_date])->where('status','2')->where('shipping_status','2')->where('order_complete','2')->get();
        $pdf = PDF::loadView('AdminDashboard/report/pdf/report_genarte_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
