<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class SettingController extends Controller
{
    public function UserSettingView(){


        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        return view('UserDashboard.Setting.view',$data);
    }

    public function UserSettingUpdate(Request $request){

        $update = User::where('id',$request->EditeId)->first();
        $update->name = $request->name;
        $update->mobile= $request->mobile;
        $update->save();

        if($request->hasFile('profile')){
            $image = $request->file('profile');
            $fullname = time().'.'.$image->getClientOriginalExtension();
            @unlink('upload/User/Profile/'.$update->profile);
            Image::make($image)->resize(500,500)->save('upload/User/Profile/'.$fullname);
            $update->profile = $fullname;
            $update->save();
        }

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($noti);

    }
}
