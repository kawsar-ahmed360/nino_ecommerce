<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Setting;
use Image;
class SettingController extends Controller
{
    public function SettingView(){

        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['logo'] = Setting::where('id','1')->first();
        return view('AdminDashboard.Setting.view',$data);
    }

    public function SettingUpdate(Request $request){

        $update = Admin::where('id',$request->EditeId)->first();
        $update->name = $request->name;
        $update->mobile= $request->mobile;
        $update->save();

        if($request->hasFile('profile')){
            $image = $request->file('profile');
            $fullname = time().'.'.$image->getClientOriginalExtension();
            @unlink('upload/Admin/Profile/'.$update->profile);
            Image::make($image)->resize(500,500)->save('upload/Admin/Profile/'.$fullname);
            $update->profile = $fullname;
            $update->save();
        }

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($noti);

    }

    //.............................Logo Manage Super Admin ....................

    public function SettingLogoView(){
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['logo'] = Setting::where('id','1')->first();
//        return $data['logo'];
        return view('AdminDashboard.Setting.Logo.logo',$data);
    }

    public function SettingLogoUpdate(Request $request){

         $update =  Setting::where('id','1')->first();
//         return $update;

        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $fullname = time().'.'.$image->getClientOriginalExtension();
            @unlink('upload/Admin/Logo/'.$update->logo);
            Image::make($image)->resize(160,42)->save('upload/Admin/Logo/'.$fullname);
            $update->logo = $fullname;
            $update->save();
        }

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($noti);

    }
}
