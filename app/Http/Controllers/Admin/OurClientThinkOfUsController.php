<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use App\Models\Admin\OurClientThinkOfUs;
use Illuminate\Support\Facades\Auth;
use Image;
class OurClientThinkOfUsController extends Controller
{
    public function OurClientThinkUsIndex(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['index'] = OurClientThinkOfUs::OrderBy('id','desc')->get();
        return view('AdminDashboard.OurClientThinkOfUs.index',$data);
    }

    public function OurClientThinkUsStore(Request $request){

        $store =new OurClientThinkOfUs();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Created',
            'alert-type'=>'success'
        );

        return redirect()->route('OurClientThinkUsIndex')->with($noti);
    }


    public function OurClientThinkUsEdite($id){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['edite'] = OurClientThinkOfUs::where('id',$id)->first();
        $data['index'] = OurClientThinkOfUs::OrderBy('id','desc')->get();
        return view('AdminDashboard.OurClientThinkOfUs.index',$data);
    }

    public function OurClientThinkUsUpdate(Request $request){

        $store =OurClientThinkOfUs::where('id',$request->EditeId)->first();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('OurClientThinkUsIndex')->with($noti);

    }

    private function save(OurClientThinkOfUs $store,Request $request){
        $store->url = $request->url;
        $store->save();

        if($request->hasFile('image')){
          $image = $request->file('image');
          @unlink('upload/Client/ClientThink/'.$store->image);
          $fullname = time().'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(264,250)->save('upload/Client/ClientThink/'.$fullname);
          $store->image = $fullname;
          $store->save();
        }


    }



    public function OurClientThinkUsDelete($id){
        $im = OurClientThinkOfUs::where('id',$id)->first();

        if($im){
            @unlink('upload/Client/ClientThink/'.$im->image);
        }
        OurClientThinkOfUs::where('id',$id)->delete();

        $noti = array(
            'message'=>'successfully Delete',
            'alert-type'=>'success'
        );

        return redirect()->route('OurClientThinkUsIndex')->with($noti);
    }

}
