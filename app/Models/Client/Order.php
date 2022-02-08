<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;



    public function payments(){

        return $this->belongsTo(Payment::class,'payment_id','id');
    }


    public function customer(){
        return $this->belongsTo(CustomerRegistration::class,'user_id','id');
    }

    public function order_details(){
        return $this->hasMany(OrderDetail::class,'order_id','id');
    }

//    public function shippings(){
//        return $this->belongsTo('App\shippings','shipping_id');
//    }

    public function BillingInfo(){
        return $this->belongsTo(BillingShipping::class,'billing_id');
    }
}
