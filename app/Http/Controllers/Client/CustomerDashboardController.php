<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Countrie;
use App\Models\Client\CustomerRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;
use Illuminate\Support\Facades\Hash;

class CustomerDashboardController extends Controller
{
    public function CustomerDashboard(){

        $data['customer_info'] = CustomerRegistration::where('id',Session::get('customer_id'))->first();
        $data['country'] = Countrie::get();
        return view('ClientSite.CustomerDashboard.CustomerDashboard',$data);
    }

    public function CustomerProfile(Request $request){

        $update = CustomerRegistration::where('id',$request->Customer_id)->first();
        $update->name = $request->name;
        $update->country_id = $request->country_id;
        $update->state_id = $request->state_id;
        $update->city_id = $request->city_id;
        $update->email = $request->email;
        $update->zip_code = $request->zip_code;
        $update->address = $request->address;
        $update->save();

        if($request->hasFile('image')){
          $image = $request->file('image');
          $fullname = time().'.'.$image->getClientOriginalExtension();
          @unlink('upload/Client/Customer_Profile/'.$update->image);
          Image::make($image)->resize(100,100)->save('upload/Client/Customer_Profile/'.$fullname);
          $update->image = $fullname;
          $update->save();
        }

        $noti = array(
            'message'=>'successfully updated',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($noti);

    }

    public function CustomerPasswordPage(){

        $data['customer_info'] = CustomerRegistration::where('id',Session::get('customer_id'))->first();
        return view('ClientSite.CustomerDashboard.Password.password',$data);
    }

    public function CustomerPasswordPost(Request $request){

        $request->validate([
            'password'=>'required',
            'Confirm_password' => 'required_with:password|same:password'
        ]);

        $match = CustomerRegistration::where('id',$request->Customer_id)->first();
        if($match){
            if (Hash::check($request->old_password,$match->password)) {

                $match->password = Hash::make($request->password);
                $match->save();

                $noti = array(
                    'message'=>'Successfully Password Change',
                    'alert-type'=>'success'
                );

                return redirect()->back()->with($noti);

            }else{
                $noti = array(
                    'message'=>'Password Not Match! Please Try Again',
                    'alert-type'=>'error'
                );

                return redirect()->back()->with($noti);
            }
        }
    }

    public function CustomerLogout($id){

        Session::forget('customer_id');
        Session::forget('customer_name');
        Session::forget('showsession');
        return redirect('/');
    }
}
