<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use App\Models\Admin\ColorManage;
use Illuminate\Support\Facades\Auth;

class ColorManageController extends Controller
{
    public function UserColorCreate(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        return view('UserDashboard.Color.create',$data);
    }

    public function UserColorIndex(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['index'] = ColorManage::OrderBy('id','desc')->get();
        return view('UserDashboard.Color.index',$data);
    }

    public function UserColorStore(Request $request){

        $store = new ColorManage();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Created',
            'alert-type'=>'success'
        );

        return redirect()->route('UserColorIndex')->with($noti);
    }

    public function UserColorEdite($id){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['edite'] = ColorManage::where('id',$id)->first();

        return view('UserDashboard.Color.edite',$data);
    }

    public function UserColorUpdate(Request $request){

        $store =ColorManage::where('id',$request->EditeId)->first();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('UserColorIndex')->with($noti);
    }

    private function save(ColorManage $store,Request $request){
        $store->color_name = $request->color_name;
        $store->user_id = Auth::user()->id;
        $store->status = $request->status;
        $store->slug = str_slug($request->color_name);
        $store->save();
    }

    public function UserColorDelete($id){

        ColorManage::where('id',$id)->delete();
        $noti = array(
            'message'=>'successfully Delete',
            'alert-type'=>'success'
        );

        return redirect()->route('UserColorIndex')->with($noti);
    }
}
