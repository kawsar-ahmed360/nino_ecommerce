<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use App\Models\Admin\Plating;
use Illuminate\Support\Facades\Auth;

class PlatingManageController extends Controller
{
    public function PlatingIndex(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['index'] = Plating::OrderBy('id','desc')->get();
        return view('AdminDashboard.Plating.index',$data);
    }

    public function PlatingStore(Request $request){

        $store =new Plating();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Created',
            'alert-type'=>'success'
        );

        return redirect()->route('PlatingIndex')->with($noti);
    }

    public function PlatingEdite($id){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['edite'] = Plating::where('id',$id)->first();
        $data['index'] = Plating::OrderBy('id','desc')->get();
        return view('AdminDashboard.Plating.index',$data);
    }

    public function PlatingUpdate(Request $request){

        $store =Plating::where('id',$request->EditeId)->first();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('PlatingIndex')->with($noti);

    }

    private function save(Plating $store,Request $request){
        $store->plating_name = $request->plating_name;
        $store->save();

    }

    public function PlatingDelete($id){
        Plating::where('id',$id)->delete();

        $noti = array(
            'message'=>'successfully Delete',
            'alert-type'=>'success'
        );

        return redirect()->route('PlatingIndex')->with($noti);
    }
}
