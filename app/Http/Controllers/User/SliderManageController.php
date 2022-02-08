<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\Setting;
use App\Models\Admin\SliderManage;
use Illuminate\Support\Facades\Auth;
use Image;

class SliderManageController extends Controller
{
    public function UserSliderIndex(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['slider'] = SliderManage::OrderBy('id','desc')->get();
        return view('UserDashboard.Slider.index',$data);
    }

    public function UserSliderCreate(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        return view('UserDashboard.Slider.create',$data);
    }

    public function UserSliderStore(Request $request){

        $store = new SliderManage();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Created',
            'alert-type'=>'success'
        );

        return redirect()->route('UserSliderIndex')->with($noti);
    }

    public function UserSliderEdite($id){

        $data['edite'] = SliderManage::where('id',$id)->first();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        return view('UserDashboard.Slider.edite',$data);
    }

    public function UserSliderUpdate(Request $request){

        $store = SliderManage::where('id',$request->EditeId)->first();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Update',
            'alert-type'=>'success'
        );

        return redirect()->route('UserSliderIndex')->with($noti);
    }

    private function save(SliderManage $store,Request $request){

        $store->user_id = Auth::User()->id;
        $store->save();

        if($request->hasFile('image')){
            $image = $request->file('image');
            $fullname = time().'.'.$image->getClientOriginalExtension();
            @unlink('upload/Client/Slider/'.$store->image);
            Image::make($image)->resize(1349,360)->save('upload/Client/Slider/'.$fullname);
            $store->image = $fullname;
            $store->save();
        }
    }

    public function UserSliderDelete($id){

        $dele = SliderManage::where('id',$id)->first();

        if($dele){
            @unlink('upload/Client/Slider/'.$dele->image);
        }
        SliderManage::where('id',$id)->delete();


        $noti = array(
            'message'=>'successfully Deleted',
            'alert-type'=>'success'
        );

        return redirect()->route('UserSliderIndex')->with($noti);
    }
}
