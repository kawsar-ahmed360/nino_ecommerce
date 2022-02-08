<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\ContactInfo;
use App\Models\Admin\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactInformationController extends Controller
{
    public function UserContactInfoIndex(){

        $data['edite'] = ContactInfo::where('id','1')->first();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        return view('UserDashboard.Contact_Info.index',$data);
    }

    public function UserContactInfoUpdate(Request $request){

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

        return redirect()->route('UserContactInfoIndex')->with($noti);
    }
}
