<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use App\Models\Admin\SectionManage;
use Illuminate\Support\Facades\Auth;
use Image;

class SectionManageController extends Controller
{
    public function UserSectionIndex(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['index'] = SectionManage::OrderBy('id','desc')->get();
        return view('UserDashboard.Section.index',$data);

    }
    public function UserSectionCreate(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        return view('UserDashboard.Section.create',$data);
    }

    public function UserSectionStore(Request $request){

        $store = new SectionManage();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Created',
            'alert-type'=>'success'
        );

        return redirect()->route('UserSectionIndex')->with($noti);
    }

    public function UserSectionEdite($id){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['edite'] = SectionManage::where('id',$id)->first();

        return view('UserDashboard.Section.edite',$data);
    }

    public function UserSectionUpdate(Request $request){

        $store = SectionManage::where('id',$request->EditeId)->first();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('UserSectionIndex')->with($noti);
    }


    private function save(SectionManage $store,Request $request){

        $store->section_name = $request->section_name;
        $store->first_add_url = $request->first_add_url;
        $store->second_add_url = $request->second_add_url;
        $store->user_id = Auth::user()->id;
        $store->highlight = $request->highlight;
        $store->save();

        if($request->hasFile('first_add_image')){
            $image = $request->file('first_add_image');
            $fullname = time().'.'.$image->getClientOriginalExtension();
            @unlink('upload/Client/first_add_image/'.$store->first_add_image);
            Image::make($image)->resize(540,174)->save('upload/Client/first_add_image/'.$fullname);
            $store->first_add_image = $fullname;
            $store->save();
        }


        if($request->hasFile('second_add_image')){
            $image = $request->file('second_add_image');
            $fullname = time().'.'.$image->getClientOriginalExtension();
            @unlink('upload/Client/second_add_image/'.$store->second_add_image);
            Image::make($image)->resize(540,174)->save('upload/Client/second_add_image/'.$fullname);
            $store->second_add_image = $fullname;
            $store->save();
        }


    }

    public function UserSectionDelete($id){

        $dele = SectionManage::where('id',$id)->first();

        if($dele){
            @unlink('upload/Client/first_add_image/'.$dele->first_add_image);
            @unlink('upload/Client/second_add_image/'.$dele->second_add_image);

        }

        SectionManage::where('id',$id)->delete();

        $noti = array(
            'message'=>'successfully Delete',
            'alert-type'=>'success'
        );

        return redirect()->route('UserSectionIndex')->with($noti);
    }
}
