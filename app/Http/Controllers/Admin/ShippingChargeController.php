<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Setting;
use App\Models\ShippingOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\ShippingCharage;

class ShippingChargeController extends Controller
{
    public function ShippingIndex(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['index'] = ShippingCharage::get();
        $data['shiping_offer'] = ShippingOffer::where('id','1')->first();
        return view('AdminDashboard.Shipping.index',$data);
    }

    public function ShippingChargeStore(Request $request){

        $store = new ShippingCharage();
        $this->save($store,$request);
        $noti = array(
            'message'=>'successfully Inserted',
            'alert-type'=>'success'
        );
        return redirect()->route('ShippingIndex')->with($noti);
    }

    public function ShippingEdite($id){
        $data['edite'] = ShippingCharage::where('id',$id)->first();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['index'] = ShippingCharage::get();
        return view('AdminDashboard.Shipping.index',$data);
    }

    public function ShippingChargeUpdate(Request $request){

        $store = ShippingCharage::where('id',$request->EditeId)->first();
        $this->save($store,$request);
        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );
        return redirect()->route('ShippingIndex')->with($noti);
    }

    protected function save(ShippingCharage $store,Request $request){

        $store->name = $request->name;
        $store->amount = $request->amount;
        $store->save();
    }

    public function ShippingDelete($id){

        $store = ShippingCharage::where('id',$id)->delete();

        $noti = array(
            'message'=>'successfully Deleted',
            'alert-type'=>'success'
        );
        return redirect()->route('ShippingIndex')->with($noti);
    }

    //-----------------------Shipping Offers---------------

    public function ShippingOfferPost(Request $request){

     $update = ShippingOffer::where('id',$request->EditeId)->first();
     $update->header = $request->header;
     $update->short = $request->short;
     $update->status = $request->status;
     $update->price_range = $request->price_range;
     $update->save();

     return redirect()->back();
    }
}
