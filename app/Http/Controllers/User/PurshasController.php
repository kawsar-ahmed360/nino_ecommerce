<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\CategoryManage;
use App\Models\Admin\purshes;
use App\Models\Admin\Setting;
use App\Models\Admin\ProductManage;
use PDF;

class PurshasController extends Controller
{
    public function Userpurshesadd(){
        // $data['supliar'] = supliars::OrderBy('id','desc')->get();
        $data['category'] =CategoryManage::get();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();

        return view('UserDashboard.purshes.purshes',$data);
    }


    public function Userpurshesadd_store(Request $Request){

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

                    return redirect()->route('Userpurshesadd_view')->with('success','data successfully inserted');
                }
            }
        }
    }
    public function Userpurshesadd_view(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();

        $data['all'] = purshes::OrderBy('date','desc')->get();

        return view('UserDashboard.purshes.view',$data);
    }

    public function Userpanding_purshes(){

        $data['all'] = purshes::OrderBy('date','desc')->where('status','0')->get();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();

        return view('UserDashboard.purshes.panding',$data);
    }



    public function Userapprove_purshes($id){

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

        return redirect()->route('Userpurshesadd_view')->with('success','done');

    }
    public function Userpurshesadd_edite(){}
    public function Userpurshesadd_update(){}


    public function Userpurshesadd_delete($id){

        $delet = purshes::find($id);

        $delet->delete();

        return redirect()->back()->with('success','data successfully deleted');
    }

    public function Userpurshesadd_dailyreport(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();

        return view('UserDashboard.purshes.daily_report',$data);
    }

    public function Userpurshesadd_dailyreport_genarate(Request $Request){

        $data['all'] = purshes::whereBetween('date',[$Request->fdate,$Request->ldate])->where('status','1')->get();


        $pdf = PDF::loadView('UserDashboard.purshes.purshes_daily_pdf',$data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
