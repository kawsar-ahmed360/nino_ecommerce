<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\PdfInfo;

class PDFInformation extends Controller
{
//$data['logo'] = Setting::where('user_id',Auth::guard('admin')->user()->id)->where('id','1')->first();
//$data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();

    public function PdfInfoIndex(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['edite'] = PdfInfo::where('id','1')->first();
        return view('AdminDashboard.Pdf.index',$data);
    }

    public function PdfInfoUpdate(Request $request){

        $update = PdfInfo::where('id',$request->EditeId)->first();
        $update->shop_title = $request->shop_title;
        $update->address = $request->address;
        $update->mobile = $request->mobile;
        $update->save();

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('PdfInfoIndex')->with($noti);
    }
}
