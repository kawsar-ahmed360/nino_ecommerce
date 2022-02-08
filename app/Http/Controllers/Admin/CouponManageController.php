<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\CouponManage;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponManageController extends Controller
{
    public function CouponIndex(){

        $data['index'] = CouponManage::get();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
         return view('AdminDashboard.Coupon.index',$data);
    }

    public function CouponStore(Request $request){

        $store = new CouponManage();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Created',
            'alert-type'=>'success'
        );

        return redirect()->route('CouponIndex')->with($noti);
    }

    public function CouponEdite($id){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['edite'] = CouponManage::where('id',$id)->first();
        $data['index'] = CouponManage::get();
        return view('AdminDashboard.Coupon.index',$data);
    }

    public function CouponUpdate(Request $request){

        $store =  CouponManage::where('id',$request->EditeId)->first();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('CouponIndex')->with($noti);

    }

    protected function save(CouponManage $store,Request $request){

        $store->coupon_name = $request->coupon_name;
        $store->amount = $request->amount;
        $store->status = $request->status;
        $store->save();
    }

    public function CouponDelete($id){

        CouponManage::where('id',$id)->delete();

        $noti = array(
            'message'=>'successfully Delete',
            'alert-type'=>'success'
        );

        return redirect()->route('CouponIndex')->with($noti);
    }
}
