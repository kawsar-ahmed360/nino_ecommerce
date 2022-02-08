<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Setting;
use App\Models\Admin\SocialIcon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialIconController extends Controller
{
    public function UserSocialIconIndex(){

        $data['index'] = SocialIcon::get();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        return view('UserDashboard.social_icon.index',$data);
    }

    public function UserSocialIconStore(Request $request){

        $store = new SocialIcon();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Store',
            'alert-type'=>'success'
        );

        return redirect()->route('UserSocialIconIndex')->with($noti);
    }

    public function UserSocialIconEdite($id){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['edite'] = SocialIcon::where('id',$id)->first();

        $data['index'] = SocialIcon::get();

        return view('UserDashboard.social_icon.index',$data);
    }

    public function  UserSocialIconUpdate(Request $request){

        $store = SocialIcon::where('id',$request->EditeId)->first();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('UserSocialIconIndex')->with($noti);

    }

    protected function save(SocialIcon $store,Request $request){

        $store->icon = $request->icon;
        $store->link = $request->link;
        $store->save();
    }

    public function UserSocialIconDelete($id){

        SocialIcon::where('id',$id)->delete();

        $noti = array(
            'message'=>'successfully Deleted',
            'alert-type'=>'success'
        );

        return redirect()->route('UserSocialIconIndex')->with($noti);
    }
}
