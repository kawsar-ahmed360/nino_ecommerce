<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\Setting;
use App\Models\Admin\TagManage;
use Illuminate\Support\Facades\Auth;

class TagManageController extends Controller
{
    public function UserTagIndex(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['index'] = TagManage::OrderBy('id','desc')->get();
        return view('UserDashboard.Tag.index',$data);
    }

    public function UserTagStore(Request $request){

        $store =new TagManage();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Created',
            'alert-type'=>'success'
        );

        return redirect()->route('UserTagIndex')->with($noti);
    }

    public function UserTagEdite($id){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['edite'] = TagManage::where('id',$id)->first();
        $data['index'] = TagManage::OrderBy('id','desc')->get();
        return view('UserDashboard.Tag.index',$data);
    }

    public function UserTagUpdate(Request $request){

        $store =TagManage::where('id',$request->EditeId)->first();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('UserTagIndex')->with($noti);

    }

    private function save(TagManage $store,Request $request){
        $store->tag_name = $request->tag_name;
        $store->save();

    }

    public function UserTagDelete($id){
        TagManage::where('id',$id)->delete();

        $noti = array(
            'message'=>'successfully Delete',
            'alert-type'=>'success'
        );

        return redirect()->route('UserTagIndex')->with($noti);
    }
}
