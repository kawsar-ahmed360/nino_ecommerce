<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use App\Models\Admin\ColorManage;
use Illuminate\Support\Facades\Auth;

class ColorManageController extends Controller
{
    public function ColorCreate(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        return view('AdminDashboard.Color.create',$data);
    }

    public function ColorIndex(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['index'] = ColorManage::OrderBy('id','desc')->get();
        return view('AdminDashboard.Color.index',$data);
    }

    public function ColorStore(Request $request){

        $store = new ColorManage();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Created',
            'alert-type'=>'success'
        );

        return redirect()->route('ColorIndex')->with($noti);
    }

    public function ColorEdite($id){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['edite'] = ColorManage::where('id',$id)->first();

        return view('AdminDashboard.Color.edite',$data);
    }

    public function ColorUpdate(Request $request){

        $store =ColorManage::where('id',$request->EditeId)->first();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('ColorIndex')->with($noti);
    }

    private function save(ColorManage $store,Request $request){
        $store->color_name = $request->color_name;
        $store->status = $request->status;
        $store->slug = str_slug($request->color_name);
        $store->save();
    }

    public function ColorDelete($id){

        ColorManage::where('id',$id)->delete();
        $noti = array(
            'message'=>'successfully Delete',
            'alert-type'=>'success'
        );

        return redirect()->route('ColorIndex')->with($noti);
    }
}
