<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Setting;
use App\Models\Admin\TagManage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagManageController extends Controller
{
    public function TagIndex(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['index'] = TagManage::OrderBy('id','desc')->get();
        return view('AdminDashboard.Tag.index',$data);
    }

    public function TagStore(Request $request){

        $store =new TagManage();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Created',
            'alert-type'=>'success'
        );

        return redirect()->route('TagIndex')->with($noti);
    }

    public function TagEdite($id){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['edite'] = TagManage::where('id',$id)->first();
        $data['index'] = TagManage::OrderBy('id','desc')->get();
        return view('AdminDashboard.Tag.index',$data);
    }

    public function TagUpdate(Request $request){

        $store =TagManage::where('id',$request->EditeId)->first();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('TagIndex')->with($noti);

    }

    private function save(TagManage $store,Request $request){
        $store->tag_name = $request->tag_name;
        $store->save();

    }

    public function TagDelete($id){
        TagManage::where('id',$id)->delete();

        $noti = array(
            'message'=>'successfully Delete',
            'alert-type'=>'success'
        );

        return redirect()->route('TagIndex')->with($noti);
    }
}
