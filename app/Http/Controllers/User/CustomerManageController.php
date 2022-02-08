<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Client\CustomerRegistration;

class CustomerManageController extends Controller
{
    public function UserAllCustomerList(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['index'] = CustomerRegistration::OrderBy('id','desc')->get();
        return view('UserDashboard.CustomerManage.all_customer_list',$data);
    }

    public function UserCustomerDelete($id){
        $cus=CustomerRegistration::where('id',$id)->first();
        if($cus){
            @unlink('upload/Client/Customer_Profile/'.$cus->image);
        }

        CustomerRegistration::where('id',$id)->delete();

        $noti = array(
            'message'=>'successfully Deleted',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($noti);
    }

    public function UserCustomerView($id){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['customer']=CustomerRegistration::where('id',$id)->first();
        return view('UserDashboard.CustomerManage.single_profile',$data);
    }

    //---------------------------Register Customer Section--------------

    public function UserAllRegisterCustomerList(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['index'] = CustomerRegistration::OrderBy('id','desc')->whereNotNull('password')->get();
        return view('UserDashboard.CustomerManage.all_register_customer_list',$data);
    }

    public function UserRegisterCustomerDelete($id){
        $cus=CustomerRegistration::where('id',$id)->first();
        if($cus){
            @unlink('upload/Client/Customer_Profile/'.$cus->image);
        }

        CustomerRegistration::where('id',$id)->delete();

        $noti = array(
            'message'=>'successfully Deleted',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($noti);
    }


    public function UserRegisterCustomerView($id){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['customer']=CustomerRegistration::where('id',$id)->first();
        return view('UserDashboard.CustomerManage.register_customer_single_view',$data);
    }

    //-----------------------Gest Customer Section---------------

    public function UserAllGestCustomerList(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['index'] = CustomerRegistration::OrderBy('id','desc')->whereNull('password')->get();
        return view('UserDashboard.CustomerManage.all_gest_customer_list',$data);
    }

    public function UserGestCustomerDelete($id){
        $cus=CustomerRegistration::where('id',$id)->first();
        if($cus){
            @unlink('upload/Client/Customer_Profile/'.$cus->image);
        }

        CustomerRegistration::where('id',$id)->delete();

        $noti = array(
            'message'=>'successfully Deleted',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($noti);
    }


    public function UserGestCustomerView($id){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['customer']=CustomerRegistration::where('id',$id)->first();
        return view('UserDashboard.CustomerManage.guest_customer_single_view',$data);
    }

}
