<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\CategoryManage;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class CategoryManageController extends Controller
{

    public function CategoryIndex(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['category'] = CategoryManage::OrderBy('id','desc')->get();
        return view('AdminDashboard.Category.index',$data);
    }

    public function CategoryCreate(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        return view('AdminDashboard.Category.create',$data);
    }

    public function CategoryStore(Request $request){

        $store = new CategoryManage();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Created',
            'alert-type'=>'success'
        );

        return redirect()->route('CategoryIndex')->with($noti);
    }

    public function CategoryEdite($id){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['edite'] = CategoryManage::where('id',$id)->first();

        return view('AdminDashboard.Category.edite',$data);
    }

    public function CategoryUpdate(Request $request){

        $store = CategoryManage::where('id',$request->EditeId)->first();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('CategoryIndex')->with($noti);
    }

    private function save(CategoryManage $store,Request $request){

          $store->category_name = $request->category_name;
          $store->highlight = $request->highlight;
          $store->meta_title = $request->meta_title;
          $store->meta_des = $request->meta_des;
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

    public function  CategoryDelete($id){

        $dele = CategoryManage::where('id',$id)->first();

        if($dele){

            @unlink('upload/Client/Category/'.$dele->image);
        }
        CategoryManage::where('id',$id)->delete();

        $noti = array(
            'message'=>'successfully Delete',
            'alert-type'=>'success'
        );

        return redirect()->route('CategoryIndex')->with($noti);
    }


}
