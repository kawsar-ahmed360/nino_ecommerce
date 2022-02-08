<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Client\CustomerRegistration;
use Illuminate\Http\Request;
use Mail;

class MultipleUserSendMail extends Controller
{
    public function UserMultipleCustomerSendMail(Request $request){

        $user = CustomerRegistration::whereIn('id',$request->send_mail)->get();

        foreach(@$user as $key=>$us){
            $data =array(
                'email'=>$us->email,
                'cust_name'=>$us->name,
                'text'=>$request->textmail,
            );

            Mail::send('UserDashboard/CustomerManage/mail/mail', $data, function ($message) use($data){
                $message->from('info@erx.life', 'Nino');
                $message->to($data['email'], 'Dear Customer');
                $message->subject('Nino Ecommerce Offer Mail');
            });
        }

        return 'ok';
    }
}
