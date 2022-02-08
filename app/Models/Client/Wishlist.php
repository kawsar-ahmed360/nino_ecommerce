<?php

namespace App\Models\Client;

use App\Models\Admin\ProductManage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;


    public function Product(){
        return $this->belongsTo(ProductManage::class,'pro_id','id');
    }
}
