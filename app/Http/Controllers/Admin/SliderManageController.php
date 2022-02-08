<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Setting;
use App\Models\Admin\SliderManage;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class SliderManageController extends Controller
{
    public function SliderIndex(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['slider'] = SliderManage::OrderBy('id','desc')->get();
        return view('AdminDashboard.Slider.index',$data);
    }

    public function SliderCreate(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        return view('AdminDashboard.Slider.create',$data);
    }

    public function SliderStore(Request $request){

        $store = new SliderManage();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Created',
            'alert-type'=>'success'
        );

        return redirect()->route('SliderIndex')->with($noti);
    }

    public function SliderEdite($id){

        $data['edite'] = SliderManage::where('id',$id)->first();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        return view('AdminDashboard.Slider.edite',$data);
    }

    public function SliderUpdate(Request $request){

        $store = SliderManage::where('id',$request->EditeId)->first();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Update',
            'alert-type'=>'success'
        );

        return redirect()->route('SliderIndex')->with($noti);
    }

    private function save(SliderManage $store,Request $request){

        if($request->hasFile('image')){
            $image = $request->file('image');
            $fullname = time().'.'.$image->getClientOriginalExtension();
            @unlink('upload/Client/Slider/'.$store->image);
            Image::make($image)->resize(1349,360)->save('upload/Client/Slider/'.$fullname);
            $store->image = $fullname;
            $store->save();
        }
    }

    public function SliderDelete($id){

        $dele = SliderManage::where('id',$id)->first();

        if($dele){
            @unlink('upload/Client/Slider/'.$dele->image);
        }
        SliderManage::where('id',$id)->delete();


        $noti = array(
            'message'=>'successfully Deleted',
            'alert-type'=>'success'
        );

        return redirect()->route('SliderIndex')->with($noti);
    }
}
