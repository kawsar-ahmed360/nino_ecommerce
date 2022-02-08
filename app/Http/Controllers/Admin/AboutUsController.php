<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\AboutUs;
use Illuminate\Http\Request;
use App\Models\Admin\Setting;
use Illuminate\Support\Facades\Auth;
use Image;
class AboutUsController extends Controller
{

    public function AboutUsIndex(){

         $data['index'] = AboutUs::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['logo'] = Setting::where('id','1')->first();
         return view('AdminDashboard.AboutUs.index',$data);

    }

    public function AboutUsEdite($id){

        $data['edite'] = AboutUs::where('id',$id)->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['logo'] = Setting::where('id','1')->first();

        return view('AdminDashboard.AboutUs.edite',$data);
    }

    public function AboutUsUpdate(Request $request){

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

        return redirect()->route('AboutUsIndex')->with($noti);
    }
}
