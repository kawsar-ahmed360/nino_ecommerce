<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\CustomerRegistration;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class CustomerRegistrationLoginController extends Controller
{

    public function CustomerLoginPage(){
        return view('ClientSite.auth.login');
    }

    public function CustomerRegistartionPage(){

        return view('ClientSite.auth.registration');
    }
    public function CustomerRegistartionPost(Request $request){

        $request->validate([
            'mobile'=>'required|numeric',
            'password'=>'required',
            'password_confirmation' => 'required_with:password|same:password'
        ]);

        $exit = CustomerRegistration::where('mobile',$request->mobile)->exists();
        if($exit){
            $noti = array(
                'message'=>'This number already exists,Please Try Another Number',
                'alert-type'=>'error'
            );

            return redirect()->back()->with($noti);
        }

        $code = rand(0000,9999);
        $customerId = rand(000,999);
        $user = new CustomerRegistration();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->mobile = $request->mobile;
        $user->IdNo = $customerId;
        $user->password = Hash::make($request->password);
        $user->code = $code;
        $user->save();

        Session::put('customer_id',$user->id);
        Session::put('customer_name',$user->name);

        if (count(Cart::content())>0) {
            return redirect()->route('CustomerCheckoutPage');
            echo  "Cart Ase";
        }else{
            return redirect('customer-dashboard');
        }
    }

    public function CustomerLoginPost(Request $request){


        $NumberMatch =CustomerRegistration::where('mobile',$request->mobile)->first();
        if($NumberMatch){
            if (Hash::check($request->password, $NumberMatch->password)) {
                if (count(Cart::content())>0) {
                    Session::put('customer_id',$NumberMatch->id);
                    Session::put('customer_name',$NumberMatch->name);
                    return redirect()->route('CustomerCheckoutPage');

                }else{
                    Session::put('customer_id',$NumberMatch->id);
                    Session::put('customer_name',$NumberMatch->name);
                    return redirect('customer-dashboard');

                }
            }else{
                $noti = array(
                    'message'=>'Password Not Match! Please Try Again',
                    'alert-type'=>'error'
                );

                return redirect()->back()->with($noti);
            }
        }else{
            $noti = array(
                'message'=>'Number Not Match! Please Try Again',
                'alert-type'=>'error'
            );

            return redirect()->back()->with($noti);
        }

    }
}
