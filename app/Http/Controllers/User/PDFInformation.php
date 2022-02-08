<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\PdfInfo;

class PDFInformation extends Controller
{
    public function UserPdfInfoIndex(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['edite'] = PdfInfo::where('id','1')->first();
        return view('UserDashboard.Pdf.index',$data);
    }

    public function UserPdfInfoUpdate(Request $request){

        $update = PdfInfo::where('id',$request->EditeId)->first();
        $update->shop_title = $request->shop_title;
        $update->address = $request->address;
        $update->mobile = $request->mobile;
        $update->save();

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('UserPdfInfoIndex')->with($noti);
    }
}
