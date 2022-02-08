<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use App\Models\Admin\OurClientThinkOfUs;
use App\Models\User;
use App\Models\Admin\Setting;
class OurClientThinkOfUsController extends Controller
{
    public function UserOurClientThinkUsIndex(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['index'] = OurClientThinkOfUs::OrderBy('id','desc')->get();
        return view('UserDashboard.OurClientThinkOfUs.index',$data);
    }

    public function UserOurClientThinkUsStore(Request $request){

        $store =new OurClientThinkOfUs();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Created',
            'alert-type'=>'success'
        );

        return redirect()->route('UserOurClientThinkUsIndex')->with($noti);
    }


    public function UserOurClientThinkUsEdite($id){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['edite'] = OurClientThinkOfUs::where('id',$id)->first();
        $data['index'] = OurClientThinkOfUs::OrderBy('id','desc')->get();
        return view('UserDashboard.OurClientThinkOfUs.index',$data);
    }

    public function UserOurClientThinkUsUpdate(Request $request){

        $store =OurClientThinkOfUs::where('id',$request->EditeId)->first();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('UserOurClientThinkUsIndex')->with($noti);

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



    public function UserOurClientThinkUsDelete($id){
        $im = OurClientThinkOfUs::where('id',$id)->first();

        if($im){
            @unlink('upload/Client/ClientThink/'.$im->image);
        }
        OurClientThinkOfUs::where('id',$id)->delete();

        $noti = array(
            'message'=>'successfully Delete',
            'alert-type'=>'success'
        );

        return redirect()->route('UserOurClientThinkUsIndex')->with($noti);
    }

}
