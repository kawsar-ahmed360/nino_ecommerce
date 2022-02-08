<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ShippingOffer;
use App\Models\User;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\ShippingCharage;

class ShippingChargeController extends Controller
{
    public function UserShippingIndex(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['index'] = ShippingCharage::get();
        $data['shiping_offer'] = ShippingOffer::where('id','1')->first();
        return view('UserDashboard.Shipping.index',$data);
    }

    public function UserShippingChargeStore(Request $request){

        $store = new ShippingCharage();
        $this->save($store,$request);
        $noti = array(
            'message'=>'successfully Inserted',
            'alert-type'=>'success'
        );
        return redirect()->route('UserShippingIndex')->with($noti);
    }

    public function UserShippingEdite($id){
        $data['edite'] = ShippingCharage::where('id',$id)->first();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['index'] = ShippingCharage::get();
        return view('UserDashboard.Shipping.index',$data);
    }

    public function UserShippingChargeUpdate(Request $request){

        $store = ShippingCharage::where('id',$request->EditeId)->first();
        $this->save($store,$request);
        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );
        return redirect()->route('UserShippingIndex')->with($noti);
    }

    protected function save(ShippingCharage $store,Request $request){

        $store->name = $request->name;
        $store->amount = $request->amount;
        $store->save();
    }

    public function UserShippingDelete($id){

        $store = ShippingCharage::where('id',$id)->delete();

        $noti = array(
            'message'=>'successfully Deleted',
            'alert-type'=>'success'
        );
        return redirect()->route('UserShippingIndex')->with($noti);
    }


    //-----------------------Shipping Offers---------------

    public function UserShippingOfferPost(Request $request){

        $update = ShippingOffer::where('id',$request->EditeId)->first();
        $update->header = $request->header;
        $update->short = $request->short;
        $update->status = $request->status;
        $update->price_range = $request->price_range;
        $update->save();

        return redirect()->back();
    }
}
