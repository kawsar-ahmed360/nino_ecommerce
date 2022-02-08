<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ProductManage;

class DefaultController extends Controller
{

    public function getPorudct(Request $Request){

        $procu = $Request->cat_id;

        $product = ProductManage::where('cat_id',$procu)->get();

        return response()->json($product);
    }
}
