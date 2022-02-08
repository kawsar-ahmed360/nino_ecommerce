<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\CouponManage;
use App\Models\Admin\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponManageController extends Controller
{
    public function UserCouponIndex(){

        $data['index'] = CouponManage::get();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        return view('UserDashboard.Coupon.index',$data);
    }

    public function UserCouponStore(Request $request){

        $store = new CouponManage();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Created',
            'alert-type'=>'success'
        );

        return redirect()->route('UserCouponIndex')->with($noti);
    }

    public function UserCouponEdite($id){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['edite'] = CouponManage::where('id',$id)->first();
        $data['index'] = CouponManage::get();
        return view('UserDashboard.Coupon.index',$data);
    }

    public function UserCouponUpdate(Request $request){

        $store =  CouponManage::where('id',$request->EditeId)->first();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('UserCouponIndex')->with($noti);

    }

    protected function save(CouponManage $store,Request $request){

        $store->coupon_name = $request->coupon_name;
        $store->amount = $request->amount;
        $store->status = $request->status;
        $store->save();
    }

    public function UserCouponDelete($id){

        CouponManage::where('id',$id)->delete();

        $noti = array(
            'message'=>'successfully Delete',
            'alert-type'=>'success'
        );

        return redirect()->route('UserCouponIndex')->with($noti);
    }
}
