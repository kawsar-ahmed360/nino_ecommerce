<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\AboutUs;
use App\Models\Admin\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutUsController extends Controller
{

    public function UserAboutUsIndex(){

        $data['index'] = AboutUs::where('id','1')->first();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        return view('UserDashboard.AboutUs.index',$data);

    }

    public function UserAboutUsEdite($id){

        $data['edite'] = AboutUs::where('id',$id)->first();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        return view('UserDashboard.AboutUs.edite',$data);
    }

    public function UserAboutUsUpdate(Request $request){

        $update = AboutUs::where('id',$request->EditeId)->first();
        $update->title = $request->title;
        $update->short_title = $request->short_title;
        $update->save();

        if($request->hasFile('image')){
            $image= $request->file('image');
            $fullname = time().'.'.$image->getClientOriginalExtension();
            @unlink('upload/Client/About/'.$update->image);
            Image::make($image)->resize(640,640)->save('upload/Client/About/'.$fullname);
            $update->image= $fullname;
            $update->save();
        }
        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('UserAboutUsIndex')->with($noti);
    }
}
