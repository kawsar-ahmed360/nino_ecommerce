<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\CategoryManage;
use App\Models\Admin\purshes;
use App\Models\Admin\Setting;
use App\Models\Admin\ProductManage;
use PDF;

class PurshasController extends Controller
{

    public function purshesadd(){
        // $data['supliar'] = supliars::OrderBy('id','desc')->get();
        $data['category'] =CategoryManage::get();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();

        return view('AdminDashboard.purshes.purshes',$data);
    }


    public function purshesadd_store(Request $Request){

        // return $Request->all();

        if ($Request->cat_id==null) {

            return redirect()->back()->with('wrong','please select cat_id');
        }else{

            if($Request->date==[null]){
                return redirect()->back()->with('wrong','please select date');
            }else{

                if($Request->purshes_no==[null]){
                    return redirect()->back()->with('wrong','please Create Purches Id');
                }else{



                    $category = count($Request->cat_id);

                    for ($i=0; $i <$category ; $i++) {

                        $pur=new purshes();
                        $pur->date = $Request->date[$i];
                        $pur->purshes_no = $Request->purshes_no[$i];
                        $pur->supliar_id = $Request->supliar_id[$i];
                        $pur->cat_id = $Request->cat_id[$i];
                        $pur->product_id = $Request->product_id[$i];
                        $pur->bying_qty = $Request->bying_qty[$i];
                        $pur->bying_price = $Request->bying_price[$i];
                        $pur->des = $Request->des[$i];
                        $pur->subtotal = $Request->subtotal[$i];
                        $pur->status = '0';


                        $pur->save();


                    }

                    return redirect()->route('purshesadd_view')->with('success','data successfully inserted');
                }
            }
        }
    }
    public function purshesadd_view(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();

        $data['all'] = purshes::OrderBy('date','desc')->get();

        return view('AdminDashboard.purshes.view',$data);
    }

    public function panding_purshes(){

        $data['all'] = purshes::OrderBy('date','desc')->where('status','0')->get();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();

        return view('AdminDashboard.purshes.panding',$data);
    }



    public function approve_purshes($id){

        $purs = purshes::find($id);

        $product = ProductManage::where('id',$purs->product_id)->first();



//        $product = products::find($Request->id);
//
//        $new_qty = $Request->product_qty;
//
//        $product_qty =$product->product_qty;
//
//        $Calculator = $new_qty-$product_qty;
//
//        //.............Old Product Qty Section-----------------
//
//        $old_total_qty = $product->total_qty;
//
//        $old_qty_increment = $old_total_qty+$Calculator;

        $product_qty = ((float)($purs->bying_qty))+((float)($product->product_qty));
        $product->product_qty=$product_qty;

        $Newproduct_qty = ((float)($purs->bying_qty))+((float)($product->total_qty));
        $product->total_qty=$Newproduct_qty;

        if ($product->save()) {

            $purs->status = '1';

            $purs->save();
        }

        return redirect()->route('purshesadd_view')->with('success','done');

    }
    public function purshesadd_edite(){}
    public function purshesadd_update(){}


    public function purshesadd_delete($id){

        $delet = purshes::find($id);

        $delet->delete();

        return redirect()->back()->with('success','data successfully deleted');
    }

    public function purshesadd_dailyreport(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();

        return view('AdminDashboard.purshes.daily_report',$data);
    }

    public function purshesadd_dailyreport_genarate(Request $Request){

        $data['all'] = purshes::whereBetween('date',[$Request->fdate,$Request->ldate])->where('status','1')->get();


        $pdf = PDF::loadView('AdminDashboard.purshes.purshes_daily_pdf',$data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
