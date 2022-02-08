<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Setting;
use App\Models\Client\CustomerRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerManageController extends Controller
{
    public function AllCustomerList(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['index'] = CustomerRegistration::OrderBy('id','desc')->get();
        return view('AdminDashboard.CustomerManage.all_customer_list',$data);
    }

    public function CustomerDelete($id){
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

    public function CustomerView($id){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['customer']=CustomerRegistration::where('id',$id)->first();
        return view('AdminDashboard.CustomerManage.single_profile',$data);
    }

    //---------------------------Register Customer Section--------------

    public function AllRegisterCustomerList(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['index'] = CustomerRegistration::OrderBy('id','desc')->whereNotNull('password')->get();
        return view('AdminDashboard.CustomerManage.all_register_customer_list',$data);
    }

    public function RegisterCustomerDelete($id){
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


    public function RegisterCustomerView($id){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['customer']=CustomerRegistration::where('id',$id)->first();
        return view('AdminDashboard.CustomerManage.register_customer_single_view',$data);
    }

    //-----------------------Gest Customer Section---------------

    public function AllGestCustomerList(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['index'] = CustomerRegistration::OrderBy('id','desc')->whereNull('password')->get();
        return view('AdminDashboard.CustomerManage.all_gest_customer_list',$data);
    }

    public function GestCustomerDelete($id){
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


    public function GestCustomerView($id){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['customer']=CustomerRegistration::where('id',$id)->first();
        return view('AdminDashboard.CustomerManage.guest_customer_single_view',$data);
    }



}
