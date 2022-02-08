<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Setting;
use App\Models\Client\AllPageSeoTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeoToolsController extends Controller
{
    public function SeoToolsIndex(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['seo'] = AllPageSeoTools::where('id','1')->first();
        return view('AdminDashboard.Seo_Tools.index',$data);
    }
    
    public function SeoToolsHomeEdite(Request $request){
        $update = AllPageSeoTools::where('id','1')->first();
        $update->home_meta_title = $request->home_meta_title;
        $update->home_meta_des = $request->home_meta_des;
        $update->home_header_code = $request->home_header_code;
        $update->save();
        return $this->SeoToolsIndex();
    }

    public function SeoToolsShopEdite(Request $request){
        $update = AllPageSeoTools::where('id','1')->first();
        $update->shop_meta_title = $request->shop_meta_title;
        $update->shop_meta_des = $request->shop_meta_des;
        $update->shop_header_code = $request->shop_header_code;
        $update->save();
        return $this->SeoToolsIndex();
    }


    public function SeoToolsContactEdite(Request $request){
        $update = AllPageSeoTools::where('id','1')->first();
        $update->contact_meta_title = $request->contact_meta_title;
        $update->contact_meta_des = $request->contact_meta_des;
        $update->contact_header_code = $request->contact_header_code;
        $update->save();
        return $this->SeoToolsIndex();
    }
}
