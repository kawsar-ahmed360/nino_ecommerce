<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Admin\AboutUs;
use App\Models\Admin\CategoryManage;
use App\Models\Admin\ColorManage;
use App\Models\Admin\OurClientThinkOfUs;
use App\Models\Admin\Page;
use App\Models\Admin\Plating;
use App\Models\Admin\ProductManage;
use App\Models\Admin\SectionManage;
use App\Models\Admin\ShippingCharage;
use App\Models\Admin\SliderManage;
use App\Models\Admin\TagManage;
use App\Models\Client\AllPageSeoTools;
use App\Models\Client\BillingShipping;
use App\Models\Client\CustomerRegistration;
use App\Models\Client\Order;
use App\Models\Client\OrderDetail;
use App\Models\Client\Wishlist;
use App\Models\ShippingOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Cart;


class FontController extends Controller
{
    public function MainIndex(){
        
        // Session::forget('billing_id');
        // Session::forget('gest_customer_id');
        // Session::forget('Total_Amount');
        // Session::forget('order_id');
        // Session::forget('show_payment_section');
        // Session::forget('show_order_section');
        // Session::forget('gest_showsession');
        // Session::forget('coupon');

        $data['slider'] = SliderManage::get();
        $data['category'] = CategoryManage::get();
        $data['about'] = AboutUs::where('id','1')->first();
        $data['section'] = SectionManage::where('highlight','1')->get();
        $data['product'] = ProductManage::get();
        $data['count'] = Cart::count();
        $data['ourclient'] = OurClientThinkOfUs::get();
        $data['meta'] = AllPageSeoTools::where('id','1')->first();
        return view('ClientSite.main',$data);
    }

    public function FilterSearchProd(Request $request){

        $data['product'] = ProductManage::where("product_name","LIKE","%".$request->Searchval."%")
            ->orWhere("summary","LIKE","%".$request->Searchval."%")
            ->where('status','1')
            ->get();
        return view('ClientSite/advance_filter/filter_search',$data);
    }

    public function AxiosCartCount(Request $request){
        $data['count'] = Cart::count();
        return response()->json($data);
    }



    public function SinglePorduct($slug){

        $data['product_details'] = ProductManage::with(['ProductGallery','ProductDetails'])->where('status','1')->where('slug',$slug)->first();
        $data['related_product'] = ProductManage::where('status','1')->where('cat_id',$data['product_details']->cat_id)->get();
        $data['show_review_form'] =0;
        if(OrderDetail::where('user_id',\Illuminate\Support\Facades\Session::get('customer_id'))->where('product_id',$data['product_details']->id)->whereNull('review')->exists()){
            $data['show_review_form'] = 1;
            $data['order_details_id'] = OrderDetail::where('user_id',\Illuminate\Support\Facades\Session::get('customer_id'))->where('product_id',$data['product_details']->id)->whereNull('review')->first();
        }else{
            $data['show_review_form'] = 2;
            $data['order_details_id'] =0;
        }
        $data['product_review'] = OrderDetail::where('product_id',$data['product_details']->id)->whereNotNull('review')->OrderBy('updated_at','desc')->get();
        return view('ClientSite.single_page.product_details',$data);
    }

    public function ShoppingCart(){

        $data['cart'] = Cart::content();
        $data['total'] = Cart::subtotal();
        if(Cart::count()<1){
         return redirect('/');
        }else{
            return view('ClientSite.single_page.shopping_cart',$data);
        }

    }

    public function CustomerCheckoutPage(){
        $data['count'] = Cart::count();
        $data['cart'] = Cart::content();
        $data['subtotal'] = Cart::subtotal();
        $data['charge'] = ShippingCharage::get();
        $data['billing_info'] = BillingShipping::where('id',Session::get('billing_id'))->orWhere('user_id',Session::get('customer_id'))->orWhere('user_id',Session::get('gest_customer_id'))->first();
        $data['order_info'] = Order::where('id',Session::get('order_id'))->orWhere('user_id',Session::get('customer_id'))->orWhere('user_id',Session::get('gest_customer_id'))->first();
        return view('ClientSite.single_page.checkout',$data);
    }

    public function ShopPage(){

        $data['product'] = ProductManage::where('status','1')->get();
        $data['tags'] = TagManage::get();
        $data['color'] = ColorManage::get();
        $data['polish'] = Plating::get();
        $data['meta'] = AllPageSeoTools::where('id','1')->first();
        $data['related_product'] = ProductManage::where('status','1')->inRandomOrder()->take(5)->get();
        return view('ClientSite.single_page.shop',$data);
    }


    //................... Shop Page Filter................
    public function ShopPageFilterTag(Request $request){
        $data['tags'] = TagManage::get();
        $tag = $request->tag;
        $price = $request->price;
        $color = $request->color;
        $polish = $request->polish;

          //..............Polish And Tag And Color && Price Filter.....
          if($tag && $polish && $color && $price=='Low to High'){

              if (@$tag == null) {
                  $data['product'] = ProductManage::where('status', '1')->get();
              }else {
                  $query = DB::table('product_manages');
                  foreach ($tag as $key => $tag2) {
                      $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                  }
                  foreach ($color as $key => $color2) {
                      $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                  }

                  foreach ($polish as $key => $polish2) {
                      $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('status', '1');
                  }
                  $data['product'] = $query->where('status', '1')->get();
                  $collection = collect($data['product']);
                  $data['product'] = $collection->sortBy('product_price');
              }
              return view('ClientSite.single_page.Filter.product', $data);
          }elseif($tag && $polish && $color && $price=='High to Low'){
              if (@$tag == null) {
                  $data['product'] = ProductManage::where('status', '1')->get();
              }else {
                  $query = DB::table('product_manages');
                  foreach ($tag as $key => $tag2) {
                      $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                  }

                  foreach ($color as $key => $color2) {
                      $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                  }

                  foreach ($polish as $key => $polish2) {
                      $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('status', '1');
                  }
                  $data['product'] = $query->where('status', '1')->get();
                  $collection = collect($data['product']);
                  $data['product'] = $collection->sortByDesc('product_price');
              }
              return view('ClientSite.single_page.Filter.product', $data);
          }elseif($tag && $polish && $color && $price=='Discount (High to Low)'){
              if (@$tag == null) {
                  $data['product'] = ProductManage::where('status', '1')->get();
              }else {
                  $query = DB::table('product_manages');
                  foreach ($tag as $key => $tag2) {
                      $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                  }
                  foreach ($color as $key => $color2) {
                      $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                  }

                  foreach ($polish as $key => $polish2) {
                      $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('status', '1');
                  }
                  $data['product'] = $query->where('status', '1')->whereNotNull('discount')->get();
                  $collection = collect($data['product']);
                  $data['product'] = $collection->sortByDesc('product_price');
              }
              return view('ClientSite.single_page.Filter.product', $data);
          }
          //..............Polish And tag And Color.....
           elseif($tag && $polish && $color){
              if (@$tag == null) {
                  $data['product'] = ProductManage::where('status', '1')->get();
              }else {
                  $query = DB::table('product_manages');
                  foreach ($tag as $key => $tag2) {
                      $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                  }

                  foreach ($color as $key => $color2) {
                      $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                  }

                  foreach ($polish as $key => $polish2) {
                      $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('status', '1');
                  }

                  $data['product'] = $query->where('status', '1')->get();

              }
              return view('ClientSite.single_page.Filter.product', $data);
          }
         //..............tag And Price And Color.....
         elseif($tag && $color && $price=='Low to High'){

             if (@$tag == null) {
                 $data['product'] = ProductManage::where('status', '1')->get();
             }else {
                 $query = DB::table('product_manages');
                 foreach ($tag as $key => $tag2) {
                     $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                 }

                 foreach ($color as $key => $color2) {
                     $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                 }
                 $data['product'] = $query->where('status', '1')->get();
                 $collection = collect($data['product']);
                 $data['product'] = $collection->sortBy('product_price');
             }
             return view('ClientSite.single_page.Filter.product', $data);

         }elseif($tag && $color && $price=='High to Low'){

             if (@$tag == null) {
                 $data['product'] = ProductManage::where('status', '1')->get();
             }else {
                 $query = DB::table('product_manages');
                 foreach ($tag as $key => $tag2) {
                     $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                 }

                 foreach ($color as $key => $color2) {
                     $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                 }
                 $data['product'] = $query->where('status', '1')->get();
                 $collection = collect($data['product']);
                 $data['product'] = $collection->sortByDesc('product_price');
             }
             return view('ClientSite.single_page.Filter.product', $data);
         }elseif($tag && $color && $price=='Discount (High to Low)'){

             if (@$tag == null) {
                 $data['product'] = ProductManage::where('status', '1')->get();
             }else {
                 $query = DB::table('product_manages');
                 foreach ($tag as $key => $tag2) {
                     $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                 }
                 foreach ($color as $key => $color2) {
                     $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                 }
                 $data['product'] = $query->where('status', '1')->whereNotNull('discount')->get();
                 $collection = collect($data['product']);
                 $data['product'] = $collection->sortByDesc('product_price');
             }
             return view('ClientSite.single_page.Filter.product', $data);
         }
         //................Tag And Plating........
         elseif($tag && $polish){

             if (@$tag == null) {
                 $data['product'] = ProductManage::where('status', '1')->get();
             }else {
                 $query = DB::table('product_manages');
                 foreach ($tag as $key => $tag2) {
                     $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                 }

                 foreach ($polish as $key => $polish2) {
                     $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('status', '1');
                 }
                 $data['product'] = $query->where('status', '1')->get();
             }
             return view('ClientSite.single_page.Filter.product', $data);
         }
         //................Tag And polish........
         elseif($tag && $color){

             if (@$tag == null) {
                 $data['product'] = ProductManage::where('status', '1')->get();
             }else {
                 $query = DB::table('product_manages');
                 foreach ($tag as $key => $tag2) {
                     $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                 }

                 foreach ($color as $key => $color2) {
                     $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                 }
                 $data['product'] = $query->where('status', '1')->get();
             }
             return view('ClientSite.single_page.Filter.product', $data);
         }
         //..............tag And Price..........
         elseif($tag && $price=='Low to High'){

             if (@$tag == null) {
                 $data['product'] = ProductManage::where('status', '1')->get();
             }else {
                 $query = DB::table('product_manages');
                 foreach ($tag as $key => $tag2) {
                     $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                 }
                 $data['product'] = $query->where('status', '1')->get();
                 $collection = collect($data['product']);
                 $data['product'] = $collection->sortBy('product_price');
             }
             return view('ClientSite.single_page.Filter.product', $data);
         }elseif($tag && $price=='High to Low'){
             if (@$tag == null) {
                 $data['product'] = ProductManage::where('status', '1')->get();
             }else {
                 $query = DB::table('product_manages');
                 foreach ($tag as $key => $tag2) {
                     $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                 }
                 $data['product'] = $query->where('status', '1')->get();
                 $collection = collect($data['product']);
                 $data['product'] = $collection->sortByDesc('product_price');
             }
             return view('ClientSite.single_page.Filter.product', $data);
         }elseif($tag && $price=='Discount (High to Low)'){
             if (@$tag == null) {
                 $data['product'] = ProductManage::where('status', '1')->get();
             }else {
                 $query = DB::table('product_manages');
                 foreach ($tag as $key => $tag2) {
                     $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                 }
                 $data['product'] = $query->where('status', '1')->whereNotNull('discount')->get();
                 $collection = collect($data['product']);
                 $data['product'] = $collection->sortByDesc('product_price');
             }
             return view('ClientSite.single_page.Filter.product', $data);
         }

         else{
             if (@$tag == null) {
                 $data['product'] = ProductManage::where('status', '1')->get();
             }else {
                 $query = DB::table('product_manages');
                 foreach ($tag as $key => $tag2) {
                     $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                 }
                 $data['product'] = $query->where('status', '1')->get();
             }
             return view('ClientSite.single_page.Filter.product', $data);
         }
    }

    public function ShopPageFilterColor(Request $request){

        $data['tags'] = TagManage::get();
        $data['color'] = ColorManage::get();
        $price = $request->price;
        $color = $request->color;
        $tag = $request->tag;
        $polish = $request->polish;

        //..............Color And Polish And Tag And Price.....
         if($color && $tag && $polish && $price=='Low to High'){
             if (@$color == null) {
                 $data['product'] = ProductManage::where('status', '1')->get();
             } else {
                 $query = DB::table('product_manages');
                 foreach ($color as $key => $color2) {
                     $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                 }

                 foreach ($tag as $key => $tag2) {
                     $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                 }

                 foreach ($polish as $key => $polish2) {
                     $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('status', '1');
                 }
                 $data['product'] = $query->where('status', '1')->get();
                 $collection = collect($data['product']);
                 $data['product'] = $collection->sortBy('product_price');
             }
             return view('ClientSite.single_page.Filter.product', $data);
         }elseif($color && $tag && $polish && $price=='High to Low'){
             if (@$color == null) {
                 $data['product'] = ProductManage::where('status', '1')->get();
             } else {
                 $query = DB::table('product_manages');
                 foreach ($color as $key => $color2) {
                     $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                 }

                 foreach ($tag as $key => $tag2) {
                     $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                 }
                 foreach ($polish as $key => $polish2) {
                     $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('status', '1');
                 }
                 $data['product'] = $query->where('status', '1')->get();
                 $collection = collect($data['product']);
                 $data['product'] = $collection->sortBy('product_price');
             }
             return view('ClientSite.single_page.Filter.product', $data);
         }elseif($color && $tag && $polish && $price=='Discount (High to Low)'){
             if (@$color == null) {
                 $data['product'] = ProductManage::where('status', '1')->get();
             } else {
                 $query = DB::table('product_manages');
                 foreach ($color as $key => $color2) {
                     $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                 }
                 foreach ($tag as $key => $tag2) {
                     $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                 }
                 foreach ($polish as $key => $polish2) {
                     $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('status', '1');
                 }
                 $data['product'] = $query->where('status', '1')->whereNotNull('discount')->get();
                 $collection = collect($data['product']);
                 $data['product'] = $collection->sortByDesc('product_price');
             }
             return view('ClientSite.single_page.Filter.product', $data);
         }
        //..............Tag And Polis And Color.....
        elseif($color && $tag && $polish){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                }

                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                }

                foreach ($polish as $key => $polish2) {
                    $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->get();

            }
            return view('ClientSite.single_page.Filter.product', $data);
        }
        //..............tag And Price And Color.....
        elseif($color && $tag && $price=='Low to High'){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                }

                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortBy('product_price');
            }
            return view('ClientSite.single_page.Filter.product', $data);
        }elseif($color && $tag && $price=='High to Low'){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                }

                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortBy('product_price');
            }
            return view('ClientSite.single_page.Filter.product', $data);
        }elseif($color && $tag && $price=='Discount (High to Low)'){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                }
                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->whereNotNull('discount')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.product', $data);
        }
        //.............. Color And Polish............
        elseif($color && $polish){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                }
                foreach ($polish as $key => $polish2) {
                    $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->get();

            }
            return view('ClientSite.single_page.Filter.product', $data);
        }
        //.............. Color And Tag............
        elseif($color && $tag){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                }
                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->get();

            }
            return view('ClientSite.single_page.Filter.product', $data);
        }
        //.............. Price And Color............
        elseif($color && $price=='Low to High'){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortBy('product_price');
            }
            return view('ClientSite.single_page.Filter.product', $data);
        }elseif($color && $price=='High to Low'){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.product', $data);
        }elseif($color && $price=='Discount (High to Low)'){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->whereNotNull('discount')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.product', $data);
        }else{

            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->get();
            }
            return view('ClientSite.single_page.Filter.product', $data);
        }
    }


    public function ShopPageFilterPolish(Request $request){

        $data['tags'] = TagManage::get();
        $data['color'] = ColorManage::get();
        $price = $request->price;
        $color = $request->color;
        $tag = $request->tag;
        $polish = $request->polish;


        //..............Polish And Tag And Color And Price.....
        if($polish && $tag && $color && $price=='Low to High'){

            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
                }
                foreach($color as $key=>$color2){
                    $query->orwhere('color_id','LIKE',"%$color2%")->where('status','1');
                }

                foreach($tag as $key=>$tag2){
                    $query->orwhere('tag_id','LIKE',"%$tag2%")->where('status','1');
                }
                $data['product']= $query->where('status','1')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortBy('product_price');
            }
            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($polish && $tag && $color && $price=='High to Low'){
            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
                }

                foreach($color as $key=>$color2){
                    $query->orwhere('color_id','LIKE',"%$color2%")->where('status','1');
                }

                foreach($tag as $key=>$tag2){
                    $query->orwhere('tag_id','LIKE',"%$tag2%")->where('status','1');
                }
                $data['product']= $query->where('status','1')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($polish && $tag && $color && $price=='Discount (High to Low)'){
            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
                }
                foreach($color as $key=>$color2){
                    $query->orwhere('color_id','LIKE',"%$color2%")->where('status','1');
                }
                foreach($tag as $key=>$tag2){
                    $query->orwhere('tag_id','LIKE',"%$tag2%")->where('status','1');
                }
                $data['product']= $query->where('status','1')->whereNotNull('discount')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.product',$data);
        }
        //..............Polish And Tag And Color.....
        elseif($polish && $tag && $color){
            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
                }
                foreach($color as $key=>$color2){
                    $query->orwhere('color_id','LIKE',"%$color2%")->where('status','1');
                }

                foreach($tag as $key=>$tag2){
                    $query->orwhere('tag_id','LIKE',"%$tag2%")->where('status','1');
                }
                $data['product']= $query->where('status','1')->get();

            }
            return view('ClientSite.single_page.Filter.product',$data);
        }
        //..............Polish And Price And Color.....
        elseif($polish && $price=='Low to High' && $color){

            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
                }
                foreach($color as $key=>$color2){
                    $query->orwhere('color_id','LIKE',"%$color2%")->where('status','1');
                }
                $data['product']= $query->where('status','1')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortBy('product_price');
            }
            return view('ClientSite.single_page.Filter.product',$data);

        }elseif($polish && $price=='High to Low' && $color){

            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
                }

                foreach($color as $key=>$color2){
                    $query->orwhere('color_id','LIKE',"%$color2%")->where('status','1');
                }
                $data['product']= $query->where('status','1')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.product',$data);

        }elseif($polish && $price=='Discount (High to Low)' && $color){
            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
                }
                foreach($color as $key=>$color2){
                    $query->orwhere('color_id','LIKE',"%$color2%")->where('status','1');
                }
                $data['product']= $query->where('status','1')->whereNotNull('discount')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.product',$data);
        }

        //..............Polish And Color.....

        elseif($polish && $color){
            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
                }
                foreach($color as $key=>$color2){
                    $query->orwhere('color_id','LIKE',"%$color2%")->where('status','1');
                }
                $data['product']= $query->where('status','1')->get();

            }
            return view('ClientSite.single_page.Filter.product',$data);
        }

        //..............Polish And Tag.....
        elseif($polish && $tag){
            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
                }
                foreach($tag as $key=>$tag2){
                    $query->orwhere('tag_id','LIKE',"%$tag2%")->where('status','1');
                }
                $data['product']= $query->where('status','1')->get();

            }
            return view('ClientSite.single_page.Filter.product',$data);
        }
        //..............Polish And Price .....

        elseif($polish && $price=='Low to High'){
            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
                }
                $data['product']= $query->where('status','1')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortBy('product_price');
            }
            return view('ClientSite.single_page.Filter.product',$data);

        }elseif($polish && $price=='High to Low'){
            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
                }
                $data['product']= $query->where('status','1')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($polish && $price=='Discount (High to Low)'){
            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
                }
                $data['product']= $query->where('status','1')->whereNotNull('discount')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.product',$data);
        } else{

        if(@$polish==null){
            $data['product'] = ProductManage::where('status','1')->get();
        }else{
            $query = DB::table('product_manages');
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->get();
        }

        return view('ClientSite.single_page.Filter.product',$data);
        }
    }

    public function ShopPageFilterPrice(Request $request){

        $name = $request->namees;
        $tag = $request->tag;
        $color = $request->color;
        $polish = $request->polish;

        //..................Name && Tag && $color && Polish...............
         if($color && $tag && $polish && $name=='Low to High'){
             $query = DB::table('product_manages');
             foreach($polish as $key=>$polish2){
                 $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
             }
             foreach($tag as $key=>$tag2){
                 $query->orwhere('tag_id','LIKE',"%$tag2%")->where('status','1');
             }

             foreach($color as $key=>$color2){
                 $query->orwhere('color_id','LIKE',"%$color2%")->where('status','1');
             }
             $data['product']= $query->where('status','1')->get();
             $collection = collect($data['product']);
             $data['product'] = $collection->sortBy('product_price');

             return view('ClientSite.single_page.Filter.product',$data);
         }elseif($color && $tag && $polish && $name=='High to Low'){
             $query = DB::table('product_manages');
             foreach($color as $key=>$color2){
                 $query->orwhere('color_id','LIKE',"%$color2%")->where('status','1');
             }
             foreach($polish as $key=>$polish2){
                 $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
             }
             foreach($tag as $key=>$tag2){
                 $query->orwhere('tag_id','LIKE',"%$tag2%")->where('status','1');
             }
             $data['product']= $query->where('status','1')->get();
             $collection = collect($data['product']);
             $data['product'] = $collection->sortByDesc('product_price');
             return view('ClientSite.single_page.Filter.product',$data);
         }elseif($color && $tag && $polish && $name=='Discount (High to Low)'){
             $query = DB::table('product_manages');
             foreach($polish as $key=>$polish2){
                 $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
             }
             foreach($color as $key=>$color2){
                 $query->orwhere('color_id','LIKE',"%$color2%")->where('status','1');
             }

             foreach($tag as $key=>$tag2){
                 $query->orwhere('tag_id','LIKE',"%$tag2%")->where('status','1');
             }
             $data['product']= $query->where('status','1')->whereNotNull('discount')->get();
             $collection = collect($data['product']);
             $data['product'] = $collection->sortByDesc('product_price');
             return view('ClientSite.single_page.Filter.product',$data);
         }
        //..................Name && Tag && $color...............
        elseif($color && $tag && $name=='Low to High'){
            $query = DB::table('product_manages');
            foreach($color as $key=>$color2){
                $query->orwhere('color_id','LIKE',"%$color2%")->where('status','1');
            }
            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortBy('product_price');

            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($color && $tag && $name=='High to Low'){
            $query = DB::table('product_manages');
            foreach($color as $key=>$color2){
                $query->orwhere('color_id','LIKE',"%$color2%")->where('status','1');
            }

            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($color && $tag && $name=='Discount (High to Low)'){
            $query = DB::table('product_manages');
            foreach($color as $key=>$color2){
                $query->orwhere('color_id','LIKE',"%$color2%")->where('status','1');
            }

            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->whereNotNull('discount')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.product',$data);
        }
        //..................Name && Tag && Polish...............
        elseif($polish && $tag && $name=='Low to High'){
            $query = DB::table('product_manages');
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
            }
            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortBy('product_price');

            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($polish && $tag && $name=='High to Low'){
            $query = DB::table('product_manages');
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
            }

            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($polish && $tag && $name=='Discount (High to Low)'){
            $query = DB::table('product_manages');
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->whereNotNull('discount')->where('status','1');
            }

            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->whereNotNull('discount')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.product',$data);
        }
        //..................Plish And Low TO Hight Section Start...............
        elseif($polish && $name=='Low to High'){

            $query = DB::table('product_manages');
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortBy('product_price');

            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($polish && $name=='High to Low'){
            $query = DB::table('product_manages');
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($polish && $name=='Relevance'){
            $query = DB::table('product_manages');
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->OrderBy('id','desc')->get();
            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($polish && $name=='Name (A to Z)'){
            $query = DB::table('product_manages');
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('product_name','REGEXP', '[a-z]')->get();
            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($polish && $name=='Discount (High to Low)'){
            $query = DB::table('product_manages');
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->whereNotNull('discount')->where('status','1');
            }
            $data['product']= $query->where('status','1')->whereNotNull('discount')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.product',$data);
        }
        //..................Color And Low TO Hight Section Start...............
        elseif($color && $name=='Low to High'){

            $query = DB::table('product_manages');
            foreach($color as $key=>$color2){
                $query->orwhere('color_id','LIKE',"%$color2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortBy('product_price');

            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($color && $name=='High to Low'){
            $query = DB::table('product_manages');
            foreach($color as $key=>$color2){
                $query->orwhere('color_id','LIKE',"%$color2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($color && $name=='Relevance'){
            $query = DB::table('product_manages');
            foreach($color as $key=>$colo2){
                $query->orwhere('color_id','LIKE',"%$colo2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->OrderBy('id','desc')->get();
            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($color && $name=='Name (A to Z)'){
            $query = DB::table('product_manages');
            foreach($color as $key=>$color2){
                $query->orwhere('color_id','LIKE',"%$color2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('product_name','REGEXP', '[a-z]')->get();
            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($color && $name=='Discount (High to Low)'){
            $query = DB::table('product_manages');
            foreach($color as $key=>$color2){
                $query->orwhere('color_id','LIKE',"%$color2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->whereNotNull('discount')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.product',$data);
        }
        //..................Tag And Low TO Hight Section Start.................
        elseif($tag && $name=='Low to High'){

            $query = DB::table('product_manages');
            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortBy('product_price');

            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($tag && $name=='High to Low'){
            $query = DB::table('product_manages');
            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($tag && $name=='Relevance'){
            $query = DB::table('product_manages');
            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->OrderBy('id','desc')->get();
            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($tag && $name=='Name (A to Z)'){
            $query = DB::table('product_manages');
            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('product_name','REGEXP', '[a-z]')->get();
            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($tag && $name=='Discount (High to Low)'){
            $query = DB::table('product_manages');
            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('status','1');
            }
            $data['product']= $query->where('status','1')->whereNotNull('discount')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.product',$data);
        }
        //..................Single Section Start.................
        elseif($name=='Relevance'){
            $data['product'] = ProductManage::OrderBy('id','desc')->where('status','1')->get();
            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($name=='Low to High'){
            $data['products'] = ProductManage::where('status','1')->get();
            $collection = collect($data['products']);
            $data['product'] = $collection->sortBy('product_price');
            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($name=='High to Low'){
            $products_high = ProductManage::where('status','1')->get();
            $collection_high = collect($products_high);
            $data['product'] = $collection_high->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($name=='Discount (High to Low)'){
            $products_high = ProductManage::where('status','1')->whereNotNull('discount')->get();
            $collection_high = collect($products_high);
            $data['product'] = $collection_high->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.product',$data);
        }elseif($name=='Name (A to Z)'){
            $data['product'] = ProductManage::where('product_name','REGEXP', '[a-z]')->where('status','1')->get();
            return view('ClientSite.single_page.Filter.product',$data);
        }
    }

    public function CategoryShopPage($id){
        $id = base64_decode($id);
        $data['product'] = ProductManage::where('status','1')->where('cat_id',$id)->get();
        $data['tags'] = TagManage::get();
        $data['color'] = ColorManage::get();
        $data['polish'] = Plating::get();
        $data['cat_id'] = $id;
        $data['meta'] = AllPageSeoTools::where('id','1')->first();
        $data['category'] = CategoryManage::where('id',$id)->first();
        $data['related_product'] = ProductManage::where('status','1')->inRandomOrder()->take(5)->get();

        return view('ClientSite.single_page.category_shop',$data);

    }


    //...................Category Shop Page Filter................
    public function CategoryShopPageFilterTag(Request $request){
        $data['tags'] = TagManage::get();
        $tag = $request->tag;
        $price = $request->price;
        $color = $request->color;
        $polish = $request->polish;
        $cat_id = $request->CatId;

        //..............Polish And Tag And Color && Price Filter.....
        if($tag && $polish && $color && $price=='Low to High'){

            if (@$tag == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            }else {
                $query = DB::table('product_manages');
                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }

                foreach ($polish as $key => $polish2) {
                    $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortBy('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }elseif($tag && $polish && $color && $price=='High to Low'){
            if (@$tag == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            }else {
                $query = DB::table('product_manages');
                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }

                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }

                foreach ($polish as $key => $polish2) {
                    $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }elseif($tag && $polish && $color && $price=='Discount (High to Low)'){
            if (@$tag == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            }else {
                $query = DB::table('product_manages');
                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }

                foreach ($polish as $key => $polish2) {
                    $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->whereNotNull('discount')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }
        //..............Polish And tag And Color.....
        elseif($tag && $polish && $color){
            if (@$tag == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            }else {
                $query = DB::table('product_manages');
                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }

                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }

                foreach ($polish as $key => $polish2) {
                    $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('cat_id',$cat_id)->where('status', '1');
                }

                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();

            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }
        //..............tag And Price And Color.....
        elseif($tag && $color && $price=='Low to High'){

            if (@$tag == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            }else {
                $query = DB::table('product_manages');
                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }

                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortBy('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);

        }elseif($tag && $color && $price=='High to Low'){

            if (@$tag == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            }else {
                $query = DB::table('product_manages');
                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }

                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }elseif($tag && $color && $price=='Discount (High to Low)'){

            if (@$tag == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            }else {
                $query = DB::table('product_manages');
                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->whereNotNull('discount')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }
        //................Tag And Plating........
        elseif($tag && $polish){

            if (@$tag == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            }else {
                $query = DB::table('product_manages');
                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }

                foreach ($polish as $key => $polish2) {
                    $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }
        //................Tag And polish........
        elseif($tag && $color){

            if (@$tag == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            }else {
                $query = DB::table('product_manages');
                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }

                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }
        //..............tag And Price..........
        elseif($tag && $price=='Low to High'){

            if (@$tag == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            }else {
                $query = DB::table('product_manages');
                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortBy('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }elseif($tag && $price=='High to Low'){
            if (@$tag == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            }else {
                $query = DB::table('product_manages');
                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }elseif($tag && $price=='Discount (High to Low)'){
            if (@$tag == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            }else {
                $query = DB::table('product_manages');
                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->whereNotNull('discount')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }

        else{
            if (@$tag == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            }else {
                $query = DB::table('product_manages');
                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }
    }

    public function CategoryShopPageFilterColor(Request $request){

        $data['tags'] = TagManage::get();
        $data['color'] = ColorManage::get();
        $price = $request->price;
        $color = $request->color;
        $tag = $request->tag;
        $polish = $request->polish;
        $cat_id = $request->CatId;

        //..............Color And Polish And Tag And Price.....
        if($color && $tag && $polish && $price=='Low to High'){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }

                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }

                foreach ($polish as $key => $polish2) {
                    $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortBy('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }elseif($color && $tag && $polish && $price=='High to Low'){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }

                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                foreach ($polish as $key => $polish2) {
                    $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortBy('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
            //--------------------------Stop Work ---------------------
            //--------------------------Stop Work ---------------------
            //--------------------------Stop Work ---------------------
            //--------------------------Stop Work ---------------------
        }elseif($color && $tag && $polish && $price=='Discount (High to Low)'){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                foreach ($polish as $key => $polish2) {
                    $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->whereNotNull('discount')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }
        //..............Tag And Polis And Color.....
        elseif($color && $tag && $polish){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }

                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }

                foreach ($polish as $key => $polish2) {
                    $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();

            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }
        //..............tag And Price And Color.....
        elseif($color && $tag && $price=='Low to High'){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }

                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortBy('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }elseif($color && $tag && $price=='High to Low'){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }

                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortBy('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }elseif($color && $tag && $price=='Discount (High to Low)'){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->whereNotNull('discount')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }
        //.............. Color And Polish............
        elseif($color && $polish){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                foreach ($polish as $key => $polish2) {
                    $query->orwhere('plation_id', 'LIKE', "%$polish2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();

            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }
        //.............. Color And Tag............
        elseif($color && $tag){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                foreach ($tag as $key => $tag2) {
                    $query->orwhere('tag_id', 'LIKE', "%$tag2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();

            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }
        //.............. Price And Color............
        elseif($color && $price=='Low to High'){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortBy('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }elseif($color && $price=='High to Low'){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }elseif($color && $price=='Discount (High to Low)'){
            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->whereNotNull('discount')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }else{

            if (@$color == null) {
                $data['product'] = ProductManage::where('status', '1')->where('cat_id',$cat_id)->get();
            } else {
                $query = DB::table('product_manages');
                foreach ($color as $key => $color2) {
                    $query->orwhere('color_id', 'LIKE', "%$color2%")->where('cat_id',$cat_id)->where('status', '1');
                }
                $data['product'] = $query->where('status', '1')->where('cat_id',$cat_id)->get();
            }
            return view('ClientSite.single_page.Filter.category_shop', $data);
        }
    }


    public function CategoryShopPageFilterPolish(Request $request){

        $data['tags'] = TagManage::get();
        $data['color'] = ColorManage::get();
        $price = $request->price;
        $color = $request->color;
        $tag = $request->tag;
        $polish = $request->polish;
        $cat_id = $request->CatId;


        //..............Polish And Tag And Color And Price.....
        if($polish && $tag && $color && $price=='Low to High'){

            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->where('cat_id',$cat_id)->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
                }
                foreach($color as $key=>$color2){
                    $query->orwhere('color_id','LIKE',"%$color2%")->where('cat_id',$cat_id)->where('status','1');
                }

                foreach($tag as $key=>$tag2){
                    $query->orwhere('tag_id','LIKE',"%$tag2%")->where('cat_id',$cat_id)->where('status','1');
                }
                $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortBy('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($polish && $tag && $color && $price=='High to Low'){
            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->where('cat_id',$cat_id)->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
                }

                foreach($color as $key=>$color2){
                    $query->orwhere('color_id','LIKE',"%$color2%")->where('cat_id',$cat_id)->where('status','1');
                }

                foreach($tag as $key=>$tag2){
                    $query->orwhere('tag_id','LIKE',"%$tag2%")->where('cat_id',$cat_id)->where('status','1');
                }
                $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($polish && $tag && $color && $price=='Discount (High to Low)'){
            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->where('cat_id',$cat_id)->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
                }
                foreach($color as $key=>$color2){
                    $query->orwhere('color_id','LIKE',"%$color2%")->where('cat_id',$cat_id)->where('status','1');
                }
                foreach($tag as $key=>$tag2){
                    $query->orwhere('tag_id','LIKE',"%$tag2%")->where('cat_id',$cat_id)->where('status','1');
                }
                $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->whereNotNull('discount')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }
        //..............Polish And Tag And Color.....
        elseif($polish && $tag && $color){
            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->where('cat_id',$cat_id)->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
                }
                foreach($color as $key=>$color2){
                    $query->orwhere('color_id','LIKE',"%$color2%")->where('cat_id',$cat_id)->where('status','1');
                }

                foreach($tag as $key=>$tag2){
                    $query->orwhere('tag_id','LIKE',"%$tag2%")->where('cat_id',$cat_id)->where('status','1');
                }
                $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();

            }
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }
        //..............Polish And Price And Color.....
        elseif($polish && $price=='Low to High' && $color){

            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->where('cat_id',$cat_id)->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
                }
                foreach($color as $key=>$color2){
                    $query->orwhere('color_id','LIKE',"%$color2%")->where('cat_id',$cat_id)->where('status','1');
                }
                $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortBy('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop',$data);

        }elseif($polish && $price=='High to Low' && $color){

            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->where('cat_id',$cat_id)->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
                }

                foreach($color as $key=>$color2){
                    $query->orwhere('color_id','LIKE',"%$color2%")->where('cat_id',$cat_id)->where('status','1');
                }
                $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop',$data);

        }elseif($polish && $price=='Discount (High to Low)' && $color){
            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->where('cat_id',$cat_id)->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
                }
                foreach($color as $key=>$color2){
                    $query->orwhere('color_id','LIKE',"%$color2%")->where('cat_id',$cat_id)->where('status','1');
                }
                $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->whereNotNull('discount')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }

        //..............Polish And Color.....

        elseif($polish && $color){
            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->where('cat_id',$cat_id)->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
                }
                foreach($color as $key=>$color2){
                    $query->orwhere('color_id','LIKE',"%$color2%")->where('cat_id',$cat_id)->where('status','1');
                }
                $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();

            }
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }

        //..............Polish And Tag.....
        elseif($polish && $tag){
            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->where('cat_id',$cat_id)->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
                }
                foreach($tag as $key=>$tag2){
                    $query->orwhere('tag_id','LIKE',"%$tag2%")->where('cat_id',$cat_id)->where('status','1');
                }
                $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();

            }
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }
        //..............Polish And Price .....

        elseif($polish && $price=='Low to High'){
            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->where('cat_id',$cat_id)->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
                }
                $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortBy('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop',$data);

        }elseif($polish && $price=='High to Low'){
            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->where('cat_id',$cat_id)->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
                }
                $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($polish && $price=='Discount (High to Low)'){
            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->where('cat_id',$cat_id)->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
                }
                $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->whereNotNull('discount')->get();
                $collection = collect($data['product']);
                $data['product'] = $collection->sortByDesc('product_price');
            }
            return view('ClientSite.single_page.Filter.category_shop',$data);
        } else{

            if(@$polish==null){
                $data['product'] = ProductManage::where('status','1')->where('cat_id',$cat_id)->get();
            }else{
                $query = DB::table('product_manages');
                foreach($polish as $key=>$polish2){
                    $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
                }
                $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();
            }

            return view('ClientSite.single_page.Filter.category_shop',$data);
        }
    }

    public function CategoryShopPageFilterPrice(Request $request){

        $name = $request->namees;
        $tag = $request->tag;
        $color = $request->color;
        $polish = $request->polish;
        $cat_id = $request->CatId;

        //..................Name && Tag && $color && Polish...............
        if($color && $tag && $polish && $name=='Low to High'){
            $query = DB::table('product_manages');
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
            }
            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('cat_id',$cat_id)->where('status','1');
            }

            foreach($color as $key=>$color2){
                $query->orwhere('color_id','LIKE',"%$color2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortBy('product_price');

            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($color && $tag && $polish && $name=='High to Low'){
            $query = DB::table('product_manages');
            foreach($color as $key=>$color2){
                $query->orwhere('color_id','LIKE',"%$color2%")->where('cat_id',$cat_id)->where('status','1');
            }
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
            }
            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($color && $tag && $polish && $name=='Discount (High to Low)'){
            $query = DB::table('product_manages');
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
            }
            foreach($color as $key=>$color2){
                $query->orwhere('color_id','LIKE',"%$color2%")->where('cat_id',$cat_id)->where('status','1');
            }

            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->whereNotNull('discount')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }
        //..................Name && Tag && $color...............
        elseif($color && $tag && $name=='Low to High'){
            $query = DB::table('product_manages');
            foreach($color as $key=>$color2){
                $query->orwhere('color_id','LIKE',"%$color2%")->where('cat_id',$cat_id)->where('status','1');
            }
            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortBy('product_price');

            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($color && $tag && $name=='High to Low'){
            $query = DB::table('product_manages');
            foreach($color as $key=>$color2){
                $query->orwhere('color_id','LIKE',"%$color2%")->where('cat_id',$cat_id)->where('status','1');
            }

            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($color && $tag && $name=='Discount (High to Low)'){
            $query = DB::table('product_manages');
            foreach($color as $key=>$color2){
                $query->orwhere('color_id','LIKE',"%$color2%")->where('cat_id',$cat_id)->where('status','1');
            }

            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->whereNotNull('discount')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }
        //..................Name && Tag && Polish...............
        elseif($polish && $tag && $name=='Low to High'){
            $query = DB::table('product_manages');
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
            }
            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortBy('product_price');

            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($polish && $tag && $name=='High to Low'){
            $query = DB::table('product_manages');
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
            }

            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($polish && $tag && $name=='Discount (High to Low)'){
            $query = DB::table('product_manages');
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->whereNotNull('discount')->where('status','1');
            }

            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->whereNotNull('discount')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }
        //..................Plish And Low TO Hight Section Start...............
        elseif($polish && $name=='Low to High'){

            $query = DB::table('product_manages');
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortBy('product_price');

            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($polish && $name=='High to Low'){
            $query = DB::table('product_manages');
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($polish && $name=='Relevance'){
            $query = DB::table('product_manages');
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->OrderBy('id','desc')->get();
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($polish && $name=='Name (A to Z)'){
            $query = DB::table('product_manages');
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->where('product_name','REGEXP', '[a-z]')->get();
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($polish && $name=='Discount (High to Low)'){
            $query = DB::table('product_manages');
            foreach($polish as $key=>$polish2){
                $query->orwhere('plation_id','LIKE',"%$polish2%")->where('cat_id',$cat_id)->whereNotNull('discount')->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->whereNotNull('discount')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }
        //..................Color And Low TO Hight Section Start...............
        elseif($color && $name=='Low to High'){

            $query = DB::table('product_manages');
            foreach($color as $key=>$color2){
                $query->orwhere('color_id','LIKE',"%$color2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortBy('product_price');

            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($color && $name=='High to Low'){
            $query = DB::table('product_manages');
            foreach($color as $key=>$color2){
                $query->orwhere('color_id','LIKE',"%$color2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($color && $name=='Relevance'){
            $query = DB::table('product_manages');
            foreach($color as $key=>$colo2){
                $query->orwhere('color_id','LIKE',"%$colo2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->OrderBy('id','desc')->get();
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($color && $name=='Name (A to Z)'){
            $query = DB::table('product_manages');
            foreach($color as $key=>$color2){
                $query->orwhere('color_id','LIKE',"%$color2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->where('product_name','REGEXP', '[a-z]')->get();
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($color && $name=='Discount (High to Low)'){
            $query = DB::table('product_manages');
            foreach($color as $key=>$color2){
                $query->orwhere('color_id','LIKE',"%$color2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->whereNotNull('discount')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }
        //..................Tag And Low TO Hight Section Start.................
        elseif($tag && $name=='Low to High'){

            $query = DB::table('product_manages');
            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortBy('product_price');

            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($tag && $name=='High to Low'){
            $query = DB::table('product_manages');
            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($tag && $name=='Relevance'){
            $query = DB::table('product_manages');
            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->OrderBy('id','desc')->get();
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($tag && $name=='Name (A to Z)'){
            $query = DB::table('product_manages');
            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->where('product_name','REGEXP', '[a-z]')->get();
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($tag && $name=='Discount (High to Low)'){
            $query = DB::table('product_manages');
            foreach($tag as $key=>$tag2){
                $query->orwhere('tag_id','LIKE',"%$tag2%")->where('cat_id',$cat_id)->where('status','1');
            }
            $data['product']= $query->where('status','1')->where('cat_id',$cat_id)->whereNotNull('discount')->get();
            $collection = collect($data['product']);
            $data['product'] = $collection->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }
        //..................Single Section Start.................
        elseif($name=='Relevance'){
            $data['product'] = ProductManage::OrderBy('id','desc')->where('cat_id',$cat_id)->where('status','1')->get();
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($name=='Low to High'){
            $data['products'] = ProductManage::where('status','1')->where('cat_id',$cat_id)->get();
            $collection = collect($data['products']);
            $data['product'] = $collection->sortBy('product_price');
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($name=='High to Low'){
            $products_high = ProductManage::where('status','1')->where('cat_id',$cat_id)->get();
            $collection_high = collect($products_high);
            $data['product'] = $collection_high->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($name=='Discount (High to Low)'){
            $products_high = ProductManage::where('status','1')->where('cat_id',$cat_id)->whereNotNull('discount')->get();
            $collection_high = collect($products_high);
            $data['product'] = $collection_high->sortByDesc('product_price');
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }elseif($name=='Name (A to Z)'){
            $data['product'] = ProductManage::where('product_name','REGEXP', '[a-z]')->where('cat_id',$cat_id)->where('status','1')->get();
            return view('ClientSite.single_page.Filter.category_shop',$data);
        }
    }



    public function AxiosGetCart(Request $request){
        $data['cart'] = Cart::content();
        return response()->json($data);
    }

    //......................Customer Review Section...................

    public function ReviewPost(Request $request){

        OrderDetail::find($request->order_details_id)->update([
            'review'=>$request->review,
            'star'=>$request->star

        ]);
        $noti = array(
            'message'=>'review done',
            'alert-type'=>'success'
        );
       return redirect()->back()->with($noti);
    }

    //.....................WishList Section..................

    public function WishlistAdd($pro_id){

         $id = base64_decode($pro_id);
         if(\Illuminate\Support\Facades\Session::has('customer_id')){
             $sessionId = Session::getId();
             $store = New Wishlist();
             $store->user_id = Session::get('customer_id');
             $store->session_id = $sessionId;
             $store->pro_id = $id;
             $store->save();

             $noti = array(
                 'message'=>'Successfully Wishlist Add',
                 'alert-type'=>'success'
             );

             return redirect('/')->with($noti);

         }else{
             $noti = array(
                 'message'=>'Please,At First Your Login Here',
                 'alert-type'=>'error'
             );

             return redirect('/Customer-login-page')->with($noti);
         }

    }

    //........................Order Traking Section................

    public function OrderTraking(Request $request){



        $orderId = $request->OrderId;
        $data['order'] = Order::where('orderId',$orderId)->exists();
        if($data['order']){

            $data['order'] =  Order::where('orderId',$orderId)->first();
            $data['order_details'] = OrderDetail::where('order_id',$data['order']->id)->get();
            $data['customer_info'] = CustomerRegistration::where('id',$data['order']->user_id)->first();
            return response()->json($data);

        }else{
            $noti = array(
                'message'=>'Order Id Not Match',
                'alert-type'=>'error'
            );

            return redirect()->back()->with($noti);
        }
//        dd($data['order']);

    }


}
