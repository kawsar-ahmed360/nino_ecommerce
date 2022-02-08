<?php

namespace App\Models\Client;

use App\Models\Admin\ProductManage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{

    protected $fillable = ['star','review'];
    use HasFactory;

    public function shippings(){

        return $this->belongsTo(BillingShipping::class,'shipping_id');

    }

    public function orders(){
        return $this->belongsTo(Order::class,'order_id','id');

    }

    public function products(){

        return $this->belongsTo(ProductManage::class,'product_id','id');
    }

    public function CustomerInfo(){

        return $this->belongsTo(CustomerRegistration::class,'user_id');
    }



}
