<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin\Setting;
use Image;
use App\Models\Admin\LogoManage;


class LogoManageController extends Controller
{
    public function UserLogoIndex(){
        $logo = Setting::where('id','1')->first();
        $info = User::where('id',Auth::user()->id)->first();
        $logo_font=LogoManage::find('1');
        return view('UserDashboard/Logo/index',compact('logo','logo_font','info'));
    }

    public function UserLogoEdite($id){
        $logo = Setting::where('id','1')->first();
        $info = User::where('id',Auth::user()->id)->first();
        $edite = LogoManage::find($id);
        return view('UserDashboard/Logo/edite',compact('edite','logo','info'));
    }

    public function UserLogoUpdate(Request $request,$id){

        $update = LogoManage::find($id);
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $fullName = time().'.'.$image->getClientOriginalExtension();
            @unlink('upload/Client/Logo/'.$update->logo);
            Image::make($image)->resize(120,60)->save('upload/Client/Logo/'.$fullName);
            $update->logo = $fullName;
            $update->save();
        }

        $update->save();

        $noti = array(
            'message'=>'Logo Successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('UserLogoIndex')->with($noti);

    }
}
