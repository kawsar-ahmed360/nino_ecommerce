<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Setting;
use App\Models\Client\AllPageSeoTools;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeoToolsController extends Controller
{
    public function UserSeoToolsIndex(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['seo'] = AllPageSeoTools::where('id','1')->first();
        return view('UserDashboard.Seo_Tools.index',$data);
    }

    public function UserSeoToolsHomeEdite(Request $request){
        $update = AllPageSeoTools::where('id','1')->first();
        $update->home_meta_title = $request->home_meta_title;
        $update->home_meta_des = $request->home_meta_des;
        $update->home_header_code = $request->home_header_code;
        $update->save();
        return $this->UserSeoToolsIndex();
    }

    public function UserSeoToolsShopEdite(Request $request){
        $update = AllPageSeoTools::where('id','1')->first();
        $update->shop_meta_title = $request->shop_meta_title;
        $update->shop_meta_des = $request->shop_meta_des;
        $update->shop_header_code = $request->shop_header_code;
        $update->save();
        return $this->UserSeoToolsIndex();
    }


    public function UserSeoToolsContactEdite(Request $request){
        $update = AllPageSeoTools::where('id','1')->first();
        $update->contact_meta_title = $request->contact_meta_title;
        $update->contact_meta_des = $request->contact_meta_des;
        $update->contact_header_code = $request->contact_header_code;
        $update->save();
        return $this->UserSeoToolsIndex();
    }
}
