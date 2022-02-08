<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use App\Models\Admin\Plating;
use Illuminate\Support\Facades\Auth;

class PlatingManageController extends Controller
{
    public function UserPlatingIndex(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['index'] = Plating::OrderBy('id','desc')->get();
        return view('UserDashboard.Plating.index',$data);
    }

    public function UserPlatingStore(Request $request){

        $store =new Plating();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Created',
            'alert-type'=>'success'
        );

        return redirect()->route('UserPlatingIndex')->with($noti);
    }

    public function UserPlatingEdite($id){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['edite'] = Plating::where('id',$id)->first();
        $data['index'] = Plating::OrderBy('id','desc')->get();
        return view('UserDashboard.Plating.index',$data);
    }

    public function UserPlatingUpdate(Request $request){

        $store =Plating::where('id',$request->EditeId)->first();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('UserPlatingIndex')->with($noti);

    }

    private function save(Plating $store,Request $request){
        $store->plating_name = $request->plating_name;
        $store->user_id = Auth::user()->id;
        $store->save();

    }

    public function UserPlatingDelete($id){
        Plating::where('id',$id)->delete();

        $noti = array(
            'message'=>'successfully Delete',
            'alert-type'=>'success'
        );

        return redirect()->route('UserPlatingIndex')->with($noti);
    }
}
