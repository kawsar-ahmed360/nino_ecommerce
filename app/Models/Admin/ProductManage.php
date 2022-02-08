<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductManage extends Model
{
    use HasFactory;

    public function ProductGallery(){

        return $this->hasMany(ProductGallery::class,'product_id','id');
    }

    public function ProductDetails(){

        return $this->hasMany(ProductDetail::class,'product_id','id');
    }
}
