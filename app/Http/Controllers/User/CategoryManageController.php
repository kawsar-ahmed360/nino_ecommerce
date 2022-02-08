<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\CategoryManage;
use App\Models\Admin\Setting;
use Illuminate\Support\Facades\Auth;
use Image;


class CategoryManageController extends Controller
{
    public function UserCategoryIndex(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['category'] = CategoryManage::OrderBy('id','desc')->get();
        return view('UserDashboard.Category.index',$data);
    }

    public function UserCategoryCreate(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        return view('UserDashboard.Category.create',$data);
    }

    public function UserCategoryStore(Request $request){

        $store = new CategoryManage();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Created',
            'alert-type'=>'success'
        );

        return redirect()->route('UserCategoryIndex')->with($noti);
    }

    public function UserCategoryEdite($id){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['edite'] = CategoryManage::where('id',$id)->first();

        return view('UserDashboard.Category.edite',$data);
    }

    public function UserCategoryUpdate(Request $request){

        $store = CategoryManage::where('id',$request->EditeId)->first();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('UserCategoryIndex')->with($noti);
    }

    private function save(CategoryManage $store,Request $request){

        $store->category_name = $request->category_name;
        $store->highlight = $request->highlight;
        $store->meta_title = $request->meta_title;
        $store->meta_des = $request->meta_des;
        $store->user_id = Auth::User()->id;
        $store->slug = str_slug($request->category_name);
        $store->save();

        if($request->hasFile('image')){
            $image = $request->file('image');
            $fullname = time().'.'.$image->getClientOriginalExtension();
            @unlink('upload/Client/Category/'.$store->image);
            Image::make($image)->resize(135,135)->save('upload/Client/Category/'.$fullname);
            $store->image = $fullname;
            $store->save();
        }
    }

    public function  UserCategoryDelete($id){

        $dele = CategoryManage::where('id',$id)->first();

        if($dele){

            @unlink('upload/Client/Category/'.$dele->image);
        }
        CategoryManage::where('id',$id)->delete();

        $noti = array(
            'message'=>'successfully Delete',
            'alert-type'=>'success'
        );

        return redirect()->route('UserCategoryIndex')->with($noti);
    }

}
