<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\LogoManage;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class LogoManageController extends Controller
{
    public function LogoIndex(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['logo_font']=LogoManage::find('1');
        return view('AdminDashboard/Logo/index',$data);
    }

    public function LogoEdite($id){
        $logo = Setting::where('id','1')->first();
        $info = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $edite = LogoManage::find($id);
        return view('AdminDashboard/Logo/edite',compact('edite','logo','info'));
    }

    public function LogoUpdate(Request $request,$id){

        $update = LogoManage::find($id);
//        $update->description = $request->description;

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $fullName = time().'.'.$image->getClientOriginalExtension();
            @unlink('upload/Client/Logo/'.$update->logo);
            Image::make($image)->resize(120,60)->save('upload/Client/Logo/'.$fullName);
            $update->logo = $fullName;
            $update->save();
        }


        if ($request->hasFile('footer_logo')) {
            $image = $request->file('footer_logo');
            $fullName = time().'.'.$image->getClientOriginalExtension();
            @unlink('upload/Client/FooterLogo/'.$update->footer_logo);
            Image::make($image)->resize(120,60)->save('upload/Client/FooterLogo/'.$fullName);
            $update->footer_logo = $fullName;
            $update->save();
        }

        $update->save();

        $noti = array(
            'message'=>'Logo Successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('LogoIndex')->with($noti);

    }

}
