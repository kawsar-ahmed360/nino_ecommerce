<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\ProductManage;

class SectionManage extends Model
{
    use HasFactory;

    public function Product(){

        return $this->hasMany(ProductManage::class,'id','id');
    }
}
