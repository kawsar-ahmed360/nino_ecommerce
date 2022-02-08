<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\ContactInfo;

class ContactInformationController extends Controller
{
    public function ContactInfoIndex(){

        $data['edite'] = ContactInfo::where('id','1')->first();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        return view('AdminDashboard.Contact_Info.index',$data);
    }

    public function ContactInfoUpdate(Request $request){

        $update = ContactInfo::where('id',$request->EditeId)->first();
        $update->phone = $request->phone;
        $update->cellphone = $request->cellphone;
        $update->email = $request->email;
        $update->web = $request->web;
        $update->save();

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('ContactInfoIndex')->with($noti);
    }
}
