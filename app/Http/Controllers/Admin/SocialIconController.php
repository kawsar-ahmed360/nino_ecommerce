<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Setting;
use App\Models\Admin\SocialIcon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialIconController extends Controller
{
    public function SocialIconIndex(){

        $data['index'] = SocialIcon::get();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        return view('AdminDashboard.social_icon.index',$data);
    }

    public function SocialIconStore(Request $request){

        $store = new SocialIcon();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Store',
            'alert-type'=>'success'
        );

        return redirect()->route('SocialIconIndex')->with($noti);
    }

    public function SocialIconEdite($id){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
          $data['edite'] = SocialIcon::where('id',$id)->first();

        $data['index'] = SocialIcon::get();

        return view('AdminDashboard.social_icon.index',$data);
    }

    public function  SocialIconUpdate(Request $request){

        $store = SocialIcon::where('id',$request->EditeId)->first();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('SocialIconIndex')->with($noti);

    }

    protected function save(SocialIcon $store,Request $request){

        $store->icon = $request->icon;
        $store->link = $request->link;
        $store->save();
    }

    public function SocialIconDelete($id){

        SocialIcon::where('id',$id)->delete();

        $noti = array(
            'message'=>'successfully Deleted',
            'alert-type'=>'success'
        );

        return redirect()->route('SocialIconIndex')->with($noti);
    }
}
