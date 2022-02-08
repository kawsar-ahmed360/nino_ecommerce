<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\CategoryManage;
use App\Models\Admin\ProductManage;

class purshes extends Model
{
    use HasFactory;

//    public function supliars(){
//
//        return $this->belongsTo('App\Admin\supliars','supliar_id');
//    }


    public function categorys(){

        return $this->belongsTo(CategoryManage::class,'cat_id');
    }

    public function products(){

        return $this->belongsTo(ProductManage::class,'product_id');
    }
}
